<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client([
    'base_uri' => 'https://restcountries.com/',
]);

try {
    $response = $client->request('GET', 'v3.1/name/russia', [
        'headers' => [
            'Accept' => 'application/json',
        ]
    ]);

    $data = json_decode($response->getBody(), true);
    $country = $data[0];
    echo "Country: " . $country['name']['common'] . "\n";
    echo "Capital: " . $country['capital'][0] . "\n";
    echo "Population: " . number_format($country['population'], 0, ',', ' ') . "\n";

} catch (RequestException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
