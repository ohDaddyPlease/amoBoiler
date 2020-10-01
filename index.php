<?php

use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\ContactModel;

require_once 'configure.php';

$contact = new ContactModel();
$contact->setName('Контакт, созданный через OAuth2.0');

try {
    $contactModel = $apiClient->contacts()->addOne($contact);
} catch (AmoCRMApiException $e) {
    var_dump($e);
}