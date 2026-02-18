<?php

use Dotenv\Dotenv;

Dotenv::createImmutable(dirname(__DIR__))->load();

defined('YII_DEBUG') or define('YII_DEBUG', filter_var($_ENV['YII_DEBUG'], FILTER_VALIDATE_BOOLEAN));
defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENV']);