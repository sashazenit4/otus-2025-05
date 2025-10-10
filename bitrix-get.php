<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

// GET запрос к JSONPlaceholder API
use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Web\Uri;

$client = new HttpClient([
    'version' => '1.1',
    'socketTimeout' => 10,
    'streamTimeout' => 30,
    'redirect' => true,
    'redirectMax' => 5,
]);

// Устанавливаем заголовки
//$client->setHeader('User-Agent', 'MyApp/1.0');
$client->setHeader('Accept', 'application/json');
//$client->setHeader('X-Custom-Header', 'custom-value');
//$client->setHeader('Authorization', 'Bearer dummy-token');

$url = 'https://jsonplaceholder.typicode.com/posts/1';
$uri = new Uri($url);
$uri->addParams([
    'q' => 1,
    's' => 'Строка поиска',
    'ext' => 'Ещё один важный параметр',
]);

$url = $url . '?' . $uri->getQuery();

try {
    $response = $client->get($url);
    $status = $client->getStatus();

    echo "Status: " . $status . '<br>';
    echo "Response: ";
    dump(json_decode($response, true));
    echo '<br>';

    if ($status >= 200 && $status < 300) {
        $data = json_decode($response, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            echo "Title: " . $data['title'] . '<br>';
            echo "Body: " . $data['body'] . '<br>';
        }
    } else {
        echo "HTTP Error: " . $status . '<br>';
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . '<br>';
}

// Дополнительная информация
echo "Content Type: " . $client->getContentType() . '<br>';
echo "Headers:\n";
dump($client->getHeaders()->toArray());
