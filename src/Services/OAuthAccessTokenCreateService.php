<?php

declare(strict_types=1);

namespace EvgeniDev\Yii2\OAuth2\Services;

use EvgeniDev\Yii2\OAuth2\Exceptions\InvalidConditionException;
use EvgeniDev\Yii2\OAuth2\Exceptions\ValidationException;
use EvgeniDev\Yii2\OAuth2\Records\OAuthAccessToken;
use EvgeniDev\Yii2\OAuth2\Records\OAuthApproval;
use Throwable;

/**
 * Access token generator service.
 */
final class OAuthAccessTokenCreateService
{
    /**
     * Generates the Access Token.
     *
     * @throws \EvgeniDev\Yii2\OAuth2\Exceptions\ValidationException
     * @throws \EvgeniDev\Yii2\OAuth2\Exceptions\InvalidConditionException
     * @throws \Throwable
     */
    public function __invoke(OAuthApproval $approval): OAuthAccessToken
    {
        try {
            $accessToken = OAuthAccessToken::find()
                ->byUserID($approval->getUserID())
                ->byClientID($approval->getClientID())
                ->one();

            if ($accessToken === null) {
                $accessToken = (new OAuthAccessToken())
                    ->setUserID($approval->getUserID())
                    ->setClientID($approval->getClientID())
                    ->setExpiresAt();
            }

            $accessToken->generateAccessToken();

            if (false === $accessToken->validate()) {
                throw new ValidationException($accessToken);
            }

            if (false === $accessToken->save()) {
                throw new InvalidConditionException();
            }

            $accessToken->refresh();

            return $accessToken;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
