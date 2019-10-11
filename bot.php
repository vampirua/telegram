<?php
require_once "vendor/autoload.php";
$token = "982221383:AAEgNznDDyQdYXeC_6eoO33jZ3mXDE_YM88";
$bot = new \TelegramBot\Api\Client($token);
$json = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
$obj = json_decode($json);
date_default_timezone_set('Ukraine/Kiev'); // CDT

$current_date = date('d/m/Y');
function send($method, $data)
{
    $url = "https://api.telegram.org/bot982221383:AAEgNznDDyQdYXeC_6eoO33jZ3mXDE_YM88". "/" . $method;

    if (!$curld = curl_init()) {
        exit;
    }
    curl_setopt($curld, CURLOPT_POST, true);
    curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curld);
    curl_close($curld);
    return $output;
}

$keyboard = [
    'inline_keyboard' => [
        [
            ['text' => 'forward me to groups', 'callback_data' => 'someString']
        ]
    ]
];
$encodedKeyboard = json_encode($keyboard);
$parameters =
    array(
        'chat_id' => $chatId,
        'text' => $response,
        'reply_markup' => $encodedKeyboard
    );

send('sendMessage', $parameters);



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


$bot->run();
?>
