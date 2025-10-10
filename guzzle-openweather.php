<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Bitrix\Main\Config\Option;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new Client([
    'base_uri' => 'http://api.openweathermap.org/',
]);

//$apiKey = Option::get('aholin.crmcustomtab', 'OPENWEATHER_TOKEN'); // Получите бесплатный ключ на openweathermap.org

$apiKey = $_ENV['OPENWEATHER_TOKEN'];
try {
    $response = $client->request('GET', 'data/2.5/weather', [
        'headers' => [
            'Accept' => 'application/json',
        ],
        'query' => [
            'q' => 'London,uk',
            'appid' => $apiKey,
            'units' => 'metric'
        ]
    ]);

    $weatherData = json_decode($response->getBody(), true);
    echo "Temperature in London: " . $weatherData['main']['temp'] . "°C\n";

} catch (RequestException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
