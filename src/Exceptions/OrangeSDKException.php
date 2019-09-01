<?php 

namespace Informagenie\Exceptions;

class OrangeSDKException extends \Exception
{
    
    public $client;

    public function __construct($message, $client)
    {
        parent::__construct($message, 0);

        $this->client = $client;
    }
}