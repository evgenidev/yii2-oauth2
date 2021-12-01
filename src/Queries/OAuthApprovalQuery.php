<?php

declare(strict_types=1);

namespace EvgeniDev\Yii2\Oauth2\Queries;

use EvgeniDev\Yii2\Oauth2\Components\ActiveQuery;

/**
 * OauthApproval repository.
 *
 * @method \EvgeniDev\Yii2\Oauth2\Records\OAuthApproval one($db = null)
 * @method \EvgeniDev\Yii2\Oauth2\Records\OAuthApproval[] all($db = null)
 */
class OAuthApprovalQuery extends ActiveQuery
{
    public function byID(string $id): self
    {
        return $this->andWhere(['ID' => $id]);
    }

    public function byClientID(string $clientID): self
    {
        return $this->andWhere(['clientID' => $clientID]);
    }

    public function byUserID(string $userID): self
    {
        return $this->andWhere(['userID' => $userID]);
    }
}
