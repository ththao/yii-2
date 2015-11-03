<?php

namespace api\components;

class ResponseHandler
{
    public $event;

    public function formatResponse()
    {
        $response = $this->event->sender;

        if ($response->statusCode === 200) {
            $response->data = [
                'success' => true,
                'data' => $response->data,
                'errors' => [],
            ];
            $response->statusCode = 200;
        } elseif ($response->statusCode === 204) {
            $response->data = [
                'success' => true,
                'data' => null,
                'errors' => [],
            ];
            $response->statusCode = 200;
        } elseif ($response->statusCode === 422) {
            $response->data = [
                'success' => false,
                'data' => null,
                'errors' => $response->data,
            ];
            $response->statusCode = 200;
        } elseif ($response->statusCode === 401) {
            $response->data = [
                'success' => false,
                'data' => null,
                'errors' => [
                    [
                        'field' => 'api_key',
                        'message' => \yii\helpers\ArrayHelper::getValue($response->data, 'message')
                    ]
                ]
            ];
            $response->statusCode = 200;
        } elseif (YII_DEBUG) {
            $response->data = [
                'success' => false,
                'data' => null,
                'errors' => $response->data
            ];
            $response->statusCode = 200;
        }
    }
} 