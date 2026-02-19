<?php

namespace app\services\ShortLink\Exceptions;

class ResourceNotFoundException extends \Exception
{
    protected $message = 'Указанный ресурс недоступен.';
}