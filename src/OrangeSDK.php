<?php

namespace Informagenie;

use Curl\Curl;

class OrangeSDK
{

    public const BASE_URI = 'https://api.orange.com';

    protected $credentials = [];

    protected $token;

    public $curl;


    public function __construct(Array $credentials)
    {
        $this->credentials = $credentials;
        $this->curl = new Curl(self::BASE_URI);
    }

    public function getToken(): String{

        $authorizationHeader = $this->getAuthorizationHeader();

        if(null === $authorizationHeader)
        {
            $authorizationHeader = 'Basic '. base64_encode($this->getClientId().':'. $this->getClientSecret());
        }

        $this->curl->setHeaders([
            'Authorization' => $authorizationHeader,
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);
        
        if(empty($this->token))
        {

            $response = $this->curl->post('/oauth/v2/token', [
                'grant_type' => 'client_credentials'
                ]);

            $this->token = $response->access_token;
        }
        
        return $this->token;
    }

    protected function getClientId()
    {
        return $this->credentials['client_id'] ?? null;
    }

    protected function getClientSecret()
    {
        return $this->credentials['client_secret'] ?? null;
    }

    protected function getAuthorizationHeader()
    {
        return $this->credentials['authorization_header'] ?? null;
    }

}