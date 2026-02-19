<?php

namespace app\components\CheckerWebResource;

use yii\httpclient\Client;

readonly class CheckerWebResource
{
    public function __construct(
        private Client $client,
    )
    {
    }

    public function check(string $url): bool
    {
        $response = $this->client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->send();

        if ($response->isOk) {
            return true;
        }

        return false;
    }
}