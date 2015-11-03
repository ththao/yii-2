<?php

namespace api\components;

class QueryParamAuth extends \yii\filters\auth\QueryParamAuth
{
    /**
     * accept POST, PUT, GET method for access token
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $accessToken = $request->get($this->tokenParam) ? $request->get($this->tokenParam) : $request->getBodyParam($this->tokenParam);
        if (is_string($accessToken)) {
            $identity = $user->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }
        if ($accessToken !== null) {
            $this->handleFailure($response);
        }

        return null;
    }
} 