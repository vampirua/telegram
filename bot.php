<?php
require_once "vendor/autoload.php";
$token = "982221383:AAEgNznDDyQdYXeC_6eoO33jZ3mXDE_YM88";
$bot = new \TelegramBot\Api\Client($token);
$json = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
$obj = json_decode($json);
date_default_timezone_set('Ukraine/Kiev'); // CDT

$current_date = date('d/m/Y');

$bot->command('USD', function ($message) use ($bot, $obj, $current_date) {
    foreach ($obj as $item) {
        var_dump($item);
        if ($item->ccy == 'USD') {
            $sale = $item->buy . 'UAH';
            $buy = $item->sale . 'UAH' .'   ' ." $current_date";

        }
    }
    $answer = " Sale :$sale , Buy : $buy";
    $bot->sendMessage($message->getChat()->getId(), $answer);

});

$bot->command('EUR', function ($message) use ($bot, $obj, $current_date) {
    foreach ($obj as $item) {
        if ($item->ccy == 'EUR') {
            $sale = $item->buy . 'UAH';
            $buy = $item->sale . 'UAH' .'   ' ." $current_date";

        }
    }
    $answer = " Sale :$sale , Buy : $buy";
    $bot->sendMessage($message->getChat()->getId(), $answer);

});
$bot->command('RUR', function ($message) use ($bot, $obj, $current_date) {
    foreach ($obj as $item) {
        if ($item->ccy == 'RUR') {
            $sale = $item->buy . 'UAH';
            $buy = $item->sale . 'UAH' .'   ' ." $current_date";
        }
    }
    $answer = " Sale :$sale , Buy : $buy";
    $bot->sendMessage($message->getChat()->getId(), $answer);

});
$bot->command('BTC', function ($message) use ($bot, $obj, $current_date) {
    foreach ($obj as $item) {
        if ($item->ccy == 'BTC') {
            $sale = $item->buy . 'UAH';
            $buy = $item->sale . 'UAH' .'   ' ." $current_date";
        }
    }
    $answer = " Sale :$sale , Buy : $buy";
    $bot->sendMessage($message->getChat()->getId(), $answer);

});

$chat_id = $bot->inlineQuery('USD','bot');

$bot->run();
?>
