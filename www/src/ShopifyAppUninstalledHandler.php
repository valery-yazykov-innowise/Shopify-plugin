<?php
namespace StoreOAuth;

use Shopify\Webhooks\Handler;

class ShopifyAppUninstalledHandler implements Handler
{
    public function handle(string $topic, string $shop, array $body): void
    {
        // Handle your webhook here!
        if(file_exists($_ENV['FILE_NAME'])) {
            unlink($_ENV['FILE_NAME']);
        }
    }
}