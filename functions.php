<?php

use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;

function putTokensToFilePlz(AccessTokenInterface $accessToken): bool
{
    $expires       = $accessToken->getExpires();
    $refresh_token = $accessToken->getRefreshToken();
    $access_token  = $accessToken->getToken();

    file_put_contents('tokens.json',
        <<<text
{
    "access_token":"$access_token",
    "refresh_token":"$refresh_token",
    "expires":"$expires"
}
text
    );
    if (isset($access_token, $refresh_token, $expires)) {
        return true;
    }
    return false;
}

function getTokens(string $baseDomain): AccessToken
{

    $accessToken = json_decode(file_get_contents('tokens.json'), true);

    $accessTokenArray = [
        'access_token'  => $accessToken['access_token']  ?? null,
        'refresh_token' => $accessToken['refresh_token'] ?? null,
        'expires'       => $accessToken['expires']       ?? null,
        'baseDomain'    => $baseDomain                   ?? null,
    ];

    if (in_array(null, $accessTokenArray)) {
        throw new InvalidArgumentException('Каки[-то параметров для \League\OAuth2\Client\Token\AccessToken нехватает');
    }

    return new AccessToken($accessTokenArray);
}