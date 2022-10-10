<!-- https://rapidapi.com/blog/openweathermap-api-overview/php/ -->
<?php

$client = new http\Client;
$request = new http\Client\Request;

$request->setRequestUrl('https://community-open-weather-map.p.rapidapi.com/weather');
$request->setRequestMethod('GET');
$request->setQuery(new http\QueryString(array(
  'q' => 'London%2Cuk'
)));

$request->setHeaders(array(
  'x-rapidapi-host' => 'community-open-weather-map.p.rapidapi.com',
  'x-rapidapi-key' => '[your rapidapi key]'
));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
?>