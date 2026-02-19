<?php

namespace app\components\RandomStringGenerator;

use app\components\RandomStringGenerator\RandomStringGeneratorInterface;
use Random\RandomException;

class RandomBytes implements RandomStringGeneratorInterface
{

    /**
     * @throws RandomException
     */
    public function generate(int $length): string
    {
        return substr(rtrim(strtr(base64_encode(random_bytes($length)), '+/', '-_')), 0, $length);
    }
}