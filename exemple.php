<?php

require __DIR__.'/vendor/autoload.php';

use Informagenie\OrangeSDK;

$sms = new OrangeSDK([
    'client_id' => 'CDyYNNygGstKdGWAN40Vu66jOd2APp8o',
    'client_secret' => '...',
    //'authorization_header' => 'Basic Q0R5WU5OeWdHc3RLZEdXQU40MFZ1NjZqT2QyQVBwOG86VTltTk15dlR4cG9OQVNFbw=='
]);



$message = $sms->message('Hello World !')
    ->from(24380000000)
    ->as('Informagenie')
    ->to(24390000000)
    ->send();
    
echo '<pre>';
print_r($message);
echo '</pre>';
