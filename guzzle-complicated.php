<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

// Создаем handler с retry middleware
$handlerStack = HandlerStack::create();

$handlerStack->push(Middleware::retry(
    function(
        $retries,
        Request $request,
        Response $response = null,
        RequestException $exception = null
    ) {
        // Максимум 3 попытки
        if ($retries >= 2) {
            return false;
        }

        // Повторяем при 5xx ошибках
        if ($response && $response->getStatusCode() >= 400) {
            return true;
        }

        // Повторяем при таймаутах
        if ($exception instanceof RequestException) {
            return true;
        }

        return false;
    }
));

$client = new Client([
    'base_uri' => 'https://jsonplaceholder.typicode.com/',
    'handler' => $handlerStack,
]);

try {
    $response = $client->request('GET', 'user', [
        'headers' => [
            'Accept' => 'application/json',
            'X-Request-ID' => uniqid()
        ],
        'query' => [
            '_limit' => 5
        ]
    ]);

    $users = json_decode($response->getBody(), true);
    foreach ($users as $user) {
        echo "User: " . $user['name'] . " (" . $user['email'] . ")\n";
    }

} catch (RequestException $e) {
    echo "Final error after retries: " . $e->getMessage() . "\n";
}
