<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client([
    'base_uri' => 'https://jsonplaceholder.typicode.com/',
]);

$updateData = [
    'id' => 1,
    'title' => 'updated title',
    'body' => 'updated body',
    'userId' => 2
];

try {
    $response = $client->request('PUT', 'posts/1', [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'json' => $updateData
    ]);

    echo "Status: " . $response->getStatusCode() . "\n";
    echo "Updated: \n";
    dump(json_decode($response->getBody(), true));

} catch (RequestException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
