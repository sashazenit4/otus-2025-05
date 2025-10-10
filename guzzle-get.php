<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client([
    'base_uri' => 'https://jsonplaceholder.typicode.com/',
    'timeout'  => 2.0,
]);

try {
    $response = $client->request('GET', 'posts/1', [
        'headers' => [
//            'User-Agent' => 'MyApp/1.0',
            'Accept' => 'application/json',
//            'X-Custom-Header' => 'custom-value',
//            'Authorization' => 'Bearer dummy-token' // для примера
        ],
    ]);

    echo "Status: " . $response->getStatusCode() . "\n";
    echo "Body: \n";
    dump(json_decode($response->getBody(), true));

} catch (RequestException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
