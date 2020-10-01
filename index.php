<?php

use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\LeadModel;

require_once 'configure.php';

$contact = new ContactModel();
$contact->setName('Контакт, созданный через OAuth2.0');

$lead = new LeadModel();
$lead->setPrice(123)->setName('Сделка, созданная через OAuth2.0');

try {
    $contactModel = $apiClient->contacts()->addOne($contact);
    $leadModel = $apiClient->leads()->addOne($lead);
} catch (AmoCRMApiException $e) {
    var_dump($e);
}