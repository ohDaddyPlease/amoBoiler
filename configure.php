<?php

require 'vendor/autoload.php';
require 'functions.php';

use AmoCRM\Client\AmoCRMApiClient;
use Symfony\Component\Dotenv\Dotenv;
use League\OAuth2\Client\Token\AccessTokenInterface;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');

$client_id          = $_ENV['CLIENT_ID'];
$client_secret      = $_ENV['CLIENT_SECRET'];
$redirect_uri       = $_ENV['REDIRECT_URI'];
$base_domain        = $_ENV['BASE_NAME'] . '.amocrm.ru';
$authorization_code = $_ENV['AUTHORIZATION_CODE'];

$apiClient = new AmoCRMApiClient(
    $client_id,
    $client_secret,
    $redirect_uri
);
$apiClient->setAccountBaseDomain($base_domain)
        ->setAccessToken(getTokens($base_domain))
        ->onAccessTokenRefresh(static function(AccessTokenInterface $accessToken) {
            putTokensToFilePlz($accessToken);
        });