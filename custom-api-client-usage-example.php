<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
// Использование
use Otus\Http\ApiClient;

$apiClient = new ApiClient();

// GET запрос
$result = $apiClient->get('https://jsonplaceholder.typicode.com/posts/1', [
    'User-Agent' => 'MyApp/1.0',
    'Accept' => 'application/json'
]);

if ($result['success']) {
    echo "GET Success: " . $result['data']['title'] . "\n";
} else {
    echo "GET Error: " . $result['error'] . "\n";
}

// POST запрос
$postResult = $apiClient->post('https://jsonplaceholder.typicode.com/posts', [
    'title' => 'Test Post',
    'body' => 'Test Content',
    'userId' => 1
], [
    'Content-Type' => 'application/json'
]);

if ($postResult['success']) {
    echo "POST Success: ID " . $postResult['data']['id'] . "\n";
} else {
    echo "POST Error: " . $postResult['error'] . "\n";
}
