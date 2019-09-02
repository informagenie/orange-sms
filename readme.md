# Orange SMS API SDK

A PHP library to send SMS through Orange SMS API

## Installation

You need to have composer installed in your computer before doing this

```bash
composer require informagenie/orange-sms
```

## Quick setup

Get `client_id` and `client_secret` [here](https://developer.orange.com/myapps/) or [follow guide](https://informagenie.com/3141/envoyer-sms-orange-sms-api/)

```php
<?php
    require_once __DIR__.'/vendor/autoload.php';

    use Informagenie\OrangeSDK;

    $credentials = [
        'client_id' => 'your_client_id',
        'client_secret' => 'your_client_secret'
    ];

    /*
       You can use directly authorization header instead of client_id and client_secret
       $credentials = [
           'authorization_header' => 'Basic xxx...',
       ];
     */

    $sms = new OrangeSDK($credentials);

    $response = $sms->message('Hello world !')
        ->from(243820000000)       // Sender phone's number
        ->as('Informagenie')      // Sender's name (optional)
        ->to(2439000000000)      // Recipiant phone's number
        ->send();

```
If all is ok, $response should be like this :

```
stdClass Object
(
    [outboundSMSMessageRequest] => stdClass Object
        (
            [address] => Array
                (
                    [0] => tel:+243900000000
                )

            [senderAddress] => tel:+243820000000
            [senderName] => Stop Ebola
            [outboundSMSTextMessage] => stdClass Object
                (
                    [message] => Hello World
                )

            [resourceURL] => https://api.orange.com/smsmessaging/v1/outbound/tel:+243820000000/requests/9d523078-1d3d-4c90-8984-7216e18deb97
        )

)
```
