<?php

require_once "vendor/autoload.php";

use Shopify\Webhooks\Registry;
use Shopify\Webhooks\Topics;
use StoreOAuth\ShopifyApiInit;
use StoreOAuth\ShopifyAppUninstalledHandler;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    ShopifyApiInit::init();
    Registry::addHandler(Topics::APP_UNINSTALLED, new ShopifyAppUninstalledHandler());

    $response = Registry::process(getallheaders(), file_get_contents('php://input'));

    if ($response->isSuccess()) {
        // Respond with HTTP 200 OK
    } else {
        // The webhook request was valid, but the handler threw an exception
    }
} catch (\Exception $error) {
    // The webhook request was not a valid one, likely a code error or it wasn't fired by Shopify
}
