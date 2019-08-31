<?php

require __DIR__.'/vendor/autoload.php';

use Informagenie\OrangeSDK;

$sms = new OrangeSDK([
    'client_id' => 'CDyYNNygGstKdGWAN40Vu66jOd2APp8o',
    'client_secret' => 'U9mNMyvTxpoNASEo',
    'authorization_header' => 'Basic Q0R5WU5OeWdHc3RLZEdXQU40MFZ1NjZqT2QyQVBwOG86VTltTk15dlR4cG9OQVNFbw=='
]);

print_r($sms->getToken());

/*
$sms->message('Code de verification 4')
    ->from('+243824109491')
    ->to('+2430971315850')
    ->send();
    */