<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client([
    'base_uri' => 'https://jsonplaceholder.typicode.com/',
]);

try {
    $response = $client->request('DELETE', 'posts/1', [
        'headers' => [
            'Authorization' => 'Bearer token123',
        ],
    ]);

    echo "Status: " . $response->getStatusCode() . "\n";
    echo "Resource deleted\n";

} catch (RequestException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
