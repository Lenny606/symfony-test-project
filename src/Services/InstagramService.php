<?php

namespace App\Services;

class InstagramService
{
    private static string $appID = '1338456723489199';
    private static string $redirectUri = 'https://localhost:17000/instagram/auth';

    public function __construct()
    {
    }

    public static function getCodeLink(): string
    {

        return 'https://www.facebook.com/v19.0/dialog/oauth?client_id=' . self::$appID . '&redirect_uri=' . self::$redirectUri . '&response_type=code&scope=instagram_graph_user_media';
    }

    public static function getAppId(): string
    {
        return self::$appID;
    }

    public static function getRedirectURI(): string
    {
        return self::$redirectUri;
    }

}