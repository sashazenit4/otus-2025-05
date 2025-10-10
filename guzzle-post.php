<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client([
    'base_uri' => 'https://jsonplaceholder.typicode.com/',
]);

$postData = [
    'title' => 'PHP 8.5 is c coming',
    'body' => 'NEW ARTICLE ABOUT PHP',
    'userId' => 2
];

try {
    $response = $client->request('POST', 'posts', [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => $postData // Guzzle автоматически кодирует в JSON
    ]);

    echo "Status: " . $response->getStatusCode() . "\n";
    echo "Response: \n";
    dump(json_decode($response->getBody(), true));

} catch (RequestException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
