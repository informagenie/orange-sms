<?php 

namespace Informagenie\Exception;

class OrangeSDKException extends \Exception
{
    
    public $client;

    public function __construct($message, $code = 0, $client)
    {
        parent::__construct($message, $code);

        $this->client = $client;
    }
}