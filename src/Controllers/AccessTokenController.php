<?php

declare(strict_types=1);

namespace EvgeniDev\Yii2\OAuth2\Controllers;

use EvgeniDev\Yii2\OAuth2\Components\Controller;
use EvgeniDev\Yii2\OAuth2\Services\OAuthAccessTokenCreateService;
use EvgeniDev\Yii2\OAuth2\Services\OAuthRequestService;
use Exception;
use Yii;
use yii\web\Response;

/**
 * Access token controller.
 */
final class AccessTokenController extends Controller
{
    /**
     * Generates the Access Token.
     */
    public function actionIndex(): Response
    {
        $request = Yii::$app->getRequest();

        $authCode = (new OAuthRequestService())->checkCode($request);

        if ($authCode instanceof Response) {
            return $authCode;
        }

        $approval = (new OAuthRequestService())->checkClientApproval($request, $authCode);

        if ($approval instanceof Response) {
            return $approval;
        }

        try {
            $token = (new OAuthAccessTokenCreateService())($approval);
        } catch (Exception $e) {
            return $this->response([
                'error' => 'Invalid Condition',
                'error_description' => 'Invalid Condition.',
            ], 500);
        }

        $authCode->delete();

        return $this->response([
            'access_token' => $token->getAccessToken(),
            'expires_at' => $token->getExpiresAt(),
        ]);
    }
}