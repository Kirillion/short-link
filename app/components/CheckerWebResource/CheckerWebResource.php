<?php

namespace app\components\CheckerWebResource;

use Throwable;
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
        try {
            $response = $this->client->createRequest()
                ->setMethod('GET')
                ->setUrl($url)
                ->send();

            if ($response->isOk) {
                return true;
            }

            return false;
        } catch (Throwable $exception) {
            return false;
        }
    }
}