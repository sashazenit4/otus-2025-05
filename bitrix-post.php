<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

// POST запрос с JSON данными
use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Web\Json;

$client = new HttpClient([
    'version' => '1.1',
    'socketTimeout' => 10,
    'streamTimeout' => 30,
]);

// Устанавливаем заголовки
$client->setHeader('Content-Type', 'application/json');
$client->setHeader('Accept', 'application/json');
$client->setHeader('User-Agent', 'MyApp/1.0');

$postData = [
    'title' => 'foo',
    'body' => 'bar',
    'userId' => 1
];

$url = 'https://jsonplaceholder.typicode.com/posts';

try {
    // Преобразуем данные в JSON
    $jsonData = Json::encode($postData);

    $response = $client->post($url, $jsonData);
    $status = $client->getStatus();

    echo "Status: " . $status . "\n";
    echo "Response: " . $response . "\n";

    if ($status >= 200 && $status < 300) {
        $data = Json::decode($response);
        echo "Created post ID: " . $data['id'] . "\n";
        echo "Title: " . $data['title'] . "\n";
        echo "User ID: " . $data['userId'] . "\n";
    } else {
        echo "HTTP Error: " . $status . "\n";
        echo "Error Info: " . var_export($client->getError(), true) . "\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
