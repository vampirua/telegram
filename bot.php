<?php
require_once "vendor/autoload.php";
$token = "982221383:AAEgNznDDyQdYXeC_6eoO33jZ3mXDE_YM88";
$bot = new \TelegramBot\Api\Client($token);
$json = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
$obj = json_decode($json);
date_default_timezone_set('Ukraine/Kiev'); // CDT

$current_date = date('d/m/Y');


$bot->command('start', function ($message) use ($bot, $obj, $current_date) {
    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("/USD", "/EUR", "/RUR",'/BTC')), true); // true for one-time keyboard
    $messageText = ' ff';
    $bot->sendMessage($message->getChat()->getId(), $messageText, null, false, null, $keyboard);
});
$bot->command('USD', function ($message) use ($bot, $obj, $current_date) {
    foreach ($obj as $item) {
        var_dump($item);
        if ($item->ccy == 'USD') {
            $sale = $item->buy . 'UAH';
            $buy = $item->sale . 'UAH' . '   ' . " $current_date";

        }
    }
    $messageText = " Sale :$sale , Buy : $buy";
    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("/USD", "/EUR", "/RUR",'/BTC')), true);
    $bot->sendMessage($message->getChat()->getId(), $messageText, null, false, null, $keyboard);

});

$bot->command('EUR', function ($message) use ($bot, $obj, $current_date) {
    foreach ($obj as $item) {
        if ($item->ccy == 'EUR') {
            $sale = $item->buy . 'UAH';
            $buy = $item->sale . 'UAH' . '   ' . " $current_date";

        }
    }
    $messageText = " Sale :$sale , Buy : $buy";
    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("/USD", "/EUR", "/RUR",'/BTC')), true);
    $bot->sendMessage($message->getChat()->getId(), $messageText, null, false, null, $keyboard);

});
$bot->command('RUR', function ($message) use ($bot, $obj, $current_date) {
    foreach ($obj as $item) {
        if ($item->ccy == 'RUR') {
            $sale = $item->buy . 'UAH';
            $buy = $item->sale . 'UAH' . '   ' . " $current_date";
        }
    }
    $messageText = " Sale :$sale , Buy : $buy";
    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("/USD", "/EUR", "/RUR",'/BTC')), true);
    $bot->sendMessage($message->getChat()->getId(), $messageText, null, false, null, $keyboard);

});
$bot->command('BTC', function ($message) use ($bot, $obj, $current_date) {
    foreach ($obj as $item) {
        if ($item->ccy == 'BTC') {
            $sale = $item->buy . 'USD';
            $buy = $item->sale . 'USD' . '   ' . " $current_date";
        }
    }
    $messageText = " Sale :$sale , Buy : $buy";
    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("/USD", "/EUR", "/RUR",'/BTC')), true);
    $bot->sendMessage($message->getChat()->getId(), $messageText, null, false, null, $keyboard);

});

$bot->run();


?>
