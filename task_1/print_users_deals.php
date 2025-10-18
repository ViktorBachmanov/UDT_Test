<?php

$data = file_get_contents('mock_data.json');

$decodedData = json_decode($data);

echo "users:" . PHP_EOL;
print_r($decodedData->users);

$filteredDeals = array_filter($decodedData->deals, function($deal)  {
    return in_array($deal->STATUS, ['WON', 'LOSE']);
});

echo "deals" . PHP_EOL;
print_r($filteredDeals);