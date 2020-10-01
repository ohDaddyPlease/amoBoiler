<?php

/*
 * Этот файл выполняется единоразово, обменивая `authorization_code` (или как его называют сокращенно - `code`) на пару
 * Access/Refresh токенов. `authorization_code` живет 20 минут или до первого использования, после чего нужно
 * взять новый.
 * Далее токены обновляются по следующей схеме:
 * - по истечению жизни Access-токена (1 день) необходимо обменять Refresh-токен на новую пару Access/Refresh токенов,
 * в свою очередь старые Access/Refresh токены будут недействительны.
 * - Refresh токен живет 30 дней. Если за это время не было запросов (Access/Refresh токены не обновлялись), то
 * потребуется снова запустить данный файл, заменив `authorization_code` на новый
 */

require_once 'configure.php';

try {
    $accessToken = $apiClient->getOAuthClient()->getAccessTokenByCode($authorization_code);
    putTokensToFilePlz($accessToken);

} catch (\Throwable $e) {
    echo "Ой-ёй! Что-то пошло не так. Скорее всего, один из параметров неверный. Проверь, плиз, сначала <b>authorization_code</b> (т.к. он действует только 20 минут), а потом и другие. Но так или иначе, лови ошибку: <br> <br> <pre>" . $e->getMessage() . "</pre>";
}