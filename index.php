<?php

require __DIR__.'/vendor/autoload.php';

use Informagenie\OrangeSDK;

$sms = new OrangeSDK([
    'client_id' => 'CDyYNNygGstKdGWAN40Vu66jOd2APp8o',
    'client_secret' => 'U9mNMyvTxpoNASEo',
    'authorization_header' => 'Basic Q0R5WU5OeWdHc3RLZEdXQU40MFZ1NjZqT2QyQVBwOG86VTltTk15dlR4cG9OQVNFbw=='
]);



$message = $sms->message('Je teste a nouveau le message')
    ->from(243824109491)
    ->as('Stop Ebola')
    ->to(243971315850)
    ->send();
echo '<pre>';
print_r($message);
echo '</pre>';
