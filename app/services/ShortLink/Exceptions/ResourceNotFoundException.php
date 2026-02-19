<?php

namespace app\services\ShortLink\Exceptions;

class ResourceNotFoundException extends \Exception
{
    protected $message = 'Данный URL не доступен.';
}