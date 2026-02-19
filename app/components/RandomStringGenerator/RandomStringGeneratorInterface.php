<?php

namespace app\components\RandomStringGenerator;

interface RandomStringGeneratorInterface
{
    public function generate(int $length): string;
}