<?php
require_once './vendor/autoload.php';

$url = 'https://jsonplaceholder.typicode.com/posts/11';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
//        'User-Agent: MyApp/1.0',
        'Accept: application/json',
//        'X-Custom-Header: custom-value',
//        'Authorization: Bearer dummy-token'
    ],
    CURLOPT_TIMEOUT => 10,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => false, // для тестирования, в продакшене true
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);

curl_close($ch);

if ($error) {
    echo "cURL Error: " . $error . "<br>";
} else {
    echo "Status: " . $httpCode . "<br>";
    echo "Response: <br>";
    dump(json_decode($response, true));

    // Декодируем JSON
    $data = json_decode($response, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        echo "Title: " . $data['title'] . "<br>";
        echo "Body: " . $data['body'] . "<br>";
    }
}
