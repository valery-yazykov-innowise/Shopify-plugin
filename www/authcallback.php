<?php

require_once "vendor/autoload.php";

use StoreOAuth\ShopifyApiClient;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

ShopifyApiClient::callback();
