<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client([
    'base_uri' => 'http://www.dneonline.com/',
    'timeout'  => 10.0,
]);

// SOAP запрос для калькулятора
$soapRequest = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
               xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <Add xmlns="http://tempuri.org/">
      <intA>11</intA>
      <intB>25</intB>
    </Add>
  </soap:Body>
</soap:Envelope>';

try {
    $response = $client->request('POST', 'calculator.asmx', [
        'headers' => [
            'Content-Type' => 'text/xml; charset=utf-8',
            'SOAPAction' => 'http://tempuri.org/Add',
            'User-Agent' => 'PHP-SOAP-Client/1.0'
        ],
        'body' => $soapRequest
    ]);

    echo "SOAP Response Status: " . $response->getStatusCode() . "\n";
    echo "SOAP Response Body:\n" . $response->getBody() . "\n";

    // Парсим ответ
    $xml = simplexml_load_string($response->getBody());
    $namespaces = $xml->getNamespaces(true);
    $body = $xml->children($namespaces['soap'])->Body;
    $addResult = $body->children()->AddResponse->AddResult;

    echo "Result of 11 + 25 = " . $addResult . "\n";

} catch (RequestException $e) {
    echo "SOAP Error: " . $e->getMessage() . "\n";
    if ($e->hasResponse()) {
        echo "Response: " . $e->getResponse()->getBody() . "\n";
    }
}
