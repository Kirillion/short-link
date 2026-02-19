<?php

namespace app\services\ShortLink\Exceptions;

class InvalidUrlResourceException extends \Exception
{
    protected $message = 'Адрес ресурса заполнен некорректно.';
}