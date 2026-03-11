<?php
session_start();

define('BASE_URL', __DIR__ . '/');
define('BASE_CSS', __DIR__ . '/storage/assets/css/');

require_once "./vendor/autoload.php";

Dotenv\Dotenv::createImmutable(__DIR__)->load();

require_once "./routes/web.php";
