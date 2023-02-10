<?php

namespace StoreOAuth;

use Shopify\Auth\OAuth;
use Shopify\Auth\Session;
use Shopify\Clients\Rest;
use Shopify\Utils;
use Shopify\Webhooks\Registry;
use Shopify\Webhooks\Topics;

class ShopifyApiClient extends ShopifyApiInit
{
    const PATH_TO_JS_FILE = 'assets/js/script.js';
    const DOMAIN_NAME = 'chocoala';
    const ENABLE_USERWERK = 1;

    public static function auth(): void
    {
        parent::init();

        $uri = OAuth::begin(
            $_ENV['STORE_NAME'],
            "authcallback.php",
            true
        );

        // Sending request to plugin install
        header("Location: " . $uri);
        exit();
    }

    // Callback registration //
    public static function callback(): void
    {
        parent::init();

        $session = OAuth::callback($_COOKIE, $_GET);

        self::registerAppUninstalledHook($session);
        self::createScriptTag($session);
        self::updateSettings(self::DOMAIN_NAME, self::ENABLE_USERWERK);

        // Create the file with application token
        file_put_contents($_ENV['FILE_NAME'], $session->getAccessToken());

        // Redirection after API install to own folder on the store
        header("Location: " . Utils::getEmbeddedAppUrl($_GET['host']));
        exit();
    }

    public static function registerAppUninstalledHook(Session $session): void
    {
        $response = Registry::register(
            'hookcallback.php',
            Topics::APP_UNINSTALLED,
            $session->getShop(),
            $session->getAccessToken(),
        );

        if ($response->isSuccess()) {
            // Webhook registered!
        } else {
        }
    }

    public static function createScriptTag(Session $session): void
    {
        // initialize ScripTag API
        $client = new Rest($session->getShop(), $session->getAccessToken());
        $client->post('script_tags', [
            "script_tag" => [
                "event" => "onload",
                "display_scope" => "order_status",
                "src" => $_ENV['SHOPIFY_APP_HOST_NAME'] . '/' . self::PATH_TO_JS_FILE,
            ],
        ]);
    }

    public static function updateSettings(string $url, int $status): void
    {
        $script = file_get_contents(self::PATH_TO_JS_FILE);
        $data = explode(';', $script, 3);
        $data[0] = sprintf("let url = '%s'", $url);
        $data[1] = sprintf("\r\nlet showPopup = %d", $status);
        $newScript = implode(';', $data);
        file_put_contents(self::PATH_TO_JS_FILE, $newScript);
        self::setSession($url, $status);
    }

    public static function initializeSettings(): void
    {
        $script = file_get_contents(self::PATH_TO_JS_FILE);
        $data = explode(';', $script, 3);

        sscanf($data[0], "let url = %s", $url);
        $url = str_replace("'", '', $url);
        sscanf($data[1], "\r\nlet showPopup = %d", $status);

        self::setSession($url, $status);
    }

    public static function setSession(string $url, int $status): void
    {
        $_SESSION['url'] = $url;
        $_SESSION['status'] = $status;
    }
}
