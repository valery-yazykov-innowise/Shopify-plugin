<?php

namespace StoreOAuth;

use Shopify\Auth\FileSessionStorage;
use Shopify\Context;

class ShopifyApiInit
{
    public static function init (): void
    {
        Context::initialize(
            $_ENV['SHOPIFY_API_KEY'],
            $_ENV['SHOPIFY_API_SECRET'],
            $_ENV['SHOPIFY_APP_SCOPES'],
            $_ENV['SHOPIFY_APP_HOST_NAME'],
            new FileSessionStorage('/tmp/php_sessions'),
            $_ENV['API_VERSION'],
            true,
            false
        );
    }
}
