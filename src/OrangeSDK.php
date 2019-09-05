<?php

namespace Informagenie;

use Curl\Curl;
use Informagenie\Exceptions\OrangeSDKException;
use stdClass;

class OrangeSDK
{

    public const BASE_URI = 'https://api.orange.com';

    protected $credentials = [];

    protected $token;

    protected $datas = [];

    public $curl;

    public function __construct(Array $credentials)
    {
        $this->credentials = $credentials;
        $this->curl = new Curl(self::BASE_URI);
        $this->getToken();
    }

    /**
     * Get generated token
     * 
     * @return stdClass|OrangeSDKException
     */
    public function getToken(){

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

            if(empty($response->access_token))
            {
                throw new OrangeSDKException(print_r($response, true), $this->curl);
            }
            $this->token = $response->access_token;
        }
        return $response ?? $this->token;
    }

    /**
     * Set message to Send
     * 
     * @param String $text text message
     * @param OrangeSDK
     */
    public function message(String $text): OrangeSDK {

        $this->datas["outboundSMSMessageRequest"]['outboundSMSTextMessage']['message'] = $text;

        return $this;
    }

    /**
     * Set sender's phone number
     * 
     * @param Int $number Phone sender
     * @return OrangeSDK
     */
    public function from(Int $number): OrangeSDK {

        $this->datas['outboundSMSMessageRequest']['senderAddress'] = 'tel:+'. $number;

        return $this;
    }

    /**
     * Set sender's Name
     * 
     * @param String $name Sender's name
     * @return OrangeSDK
     */
    public function as(String $name): OrangeSDK {

        $this->datas['outboundSMSMessageRequest']['senderName'] = $name;

        return $this;
    }

    /**
     * Set receiver's phone number
     * 
     * @param $number : Phone sender
     * @return OrangeSDK
     */
    public function to(Int $number): OrangeSDK {

        $this->datas['outboundSMSMessageRequest']['address'] = 'tel:+'. $number;

        return $this;
    }

    /**
     * Send SMS
     * 
     * @return stdClass|OrangeSDKException
     */
    public function send(){

        $this->curl->setHeader('Authorization', 'Bearer ' . $this->getToken());
        $this->curl->setHeader('Content-Type', 'application/json');

        $url = '/smsmessaging/v1/outbound/'. urlencode($this->datas['outboundSMSMessageRequest']['senderAddress']) . '/requests';

        $response = $this->curl->post($url, $this->datas);

        if(isset($response->outboundSMSMessageRequest))
        {
            return $response;
        }

        throw new OrangeSDKException('Error while sending SMS ', $this->curl);
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