<?php

declare(strict_types=1);

namespace EvgeniDev\Yii2\OAuth2\Queries;

use EvgeniDev\Yii2\OAuth2\Components\ActiveQuery;

/**
 * OAuthAuthorizationCode repository.
 *
 * @method \EvgeniDev\Yii2\OAuth2\Records\OAuthAuthorizationCode one($db = null)
 * @method \EvgeniDev\Yii2\OAuth2\Records\OAuthAuthorizationCode[] all($db = null)
 */
class OAuthAuthorizationCodeQuery extends ActiveQuery
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

    public function byAuthorizationCode(string $authorizationCode): self
    {
        return $this->andWhere(['authorizationCode' => $authorizationCode]);
    }
}
