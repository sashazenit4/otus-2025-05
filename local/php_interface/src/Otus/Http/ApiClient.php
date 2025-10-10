<?php
namespace Otus\Http;

use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Web\Json;

class ApiClient {
    private $client;

    public function __construct($options = []) {
        $defaultOptions = [
            'version' => '1.1',
            'socketTimeout' => 10,
            'streamTimeout' => 30,
            'redirect' => true,
            'redirectMax' => 5,
        ];

        $this->client = new HttpClient(array_merge($defaultOptions, $options));
    }

    public function setHeaders($headers) {
        foreach ($headers as $name => $value) {
            $this->client->setHeader($name, $value);
        }
    }

    public function get($url, $headers = []) {
        try {
            $this->setHeaders($headers);
            $response = $this->client->get($url);

            return [
                'success' => true,
                'status' => $this->client->getStatus(),
                'data' => Json::decode($response),
                'raw_response' => $response
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'status' => $this->client->getStatus()
            ];
        }
    }

    public function post($url, $data, $headers = []) {
        try {
            $this->setHeaders($headers);
            $jsonData = Json::encode($data);

            $response = $this->client->post($url, $jsonData);

            return [
                'success' => true,
                'status' => $this->client->getStatus(),
                'data' => Json::decode($response),
                'raw_response' => $response
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'status' => $this->client->getStatus()
            ];
        }
    }
}
