<?php

session_start();

require_once "vendor/autoload.php";

use StoreOAuth\ShopifyApiClient;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (!file_exists($_ENV['FILE_NAME'])) {
    ShopifyApiClient::auth();
} else {
    ShopifyApiClient::initializeSettings();
    require_once 'apppage.php';
}
