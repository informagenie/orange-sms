# Orange SMS API SDK

A PHP library to send SMS via Orange SMS API

## Installation

You need to have composer installed in your computer before doing this

```bash
composer require informagenie/orange-api-sms
```

## Loading

```php
require_once __DIR__.'/vendor/autoload.php';
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

    /**
     *  You can use directly authorization header instead of client_id and client_secret
     *  $credentials = [
     *      'authorization_header' => 'Basic xxx...',
     *  ];
     */

    $sms = new OrangeSdk($credentials);

    $sms->message('Je teste à nouveau le message')
        ->from(243824109491)    // Sender phone's number
        ->as('Stop Ebola')      // Sender's name (optional)
        ->to(243971315850)      // Recipiant phone's number
        ->send();               // return true/false

```
