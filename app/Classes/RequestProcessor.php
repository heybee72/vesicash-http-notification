<?php

namespace App\Classes;

use GuzzleHttp\Client;
use App\Exceptions\IsNullException;

class RequestProcessor
{
    /**
     * Instance of Client
     * @var Client
     */
    protected $client;

    /**
     *  Response from requests made to Authentication Service
     * @var mixed
     */
    protected $response;

    public function __construct()
    {
        $this->setRequestOptions();
    }

    /**
     * Set options for making the Client request
     */
    private function setRequestOptions()
    {
        $this->client = new Client(
            [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json'
                ]
            ]
        );
    }

    /**
     * @param string $relativeUrl
     * @param string $method
     * @param array $body
     * @throws IsNullException
     */
    public function setHttpResponse($relativeUrl, $method, $body = [])
    {
        $this->setRequestOptions();
        if (is_null($method)) {
            throw new IsNullException("Empty method not allowed");
        }

        $this->response = $this->client->{strtolower($method)}(
            $relativeUrl,
            ["body" => json_encode($body)]
        );

        return $this;
    }


    /**
     * Get the whole response from a get operation
     * @return array
     */
    public function getResponse()
    {
        return json_decode($this->response->getBody(), true);
    }
}
