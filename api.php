<?php

$json = file_get_contents('https://api.privatbank.ua/p24api/exchange_rates?json&date=06.10.2019');
$obj = json_decode($json);

foreach ($obj as $item) {

    foreach ($item as $value)
    if ($value->currency == 'USD') {
        $sale = $value->saleRate;

        print_r($sale);
    }
}


