<?php
require_once "vendor/autoload.php";
$token = "982221383:AAEgNznDDyQdYXeC_6eoO33jZ3mXDE_YM88";
$bot = new \TelegramBot\Api\Client($token);
$json = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
$obj = json_decode($json);

$bot->command('USD', function ($message) use ($bot,$obj) {
    foreach ($obj as $item) {
        var_dump($item);
            if ($item->ccy == 'USD') {

                var_dump($sale = $item->buy);
                $buy = $item->sale;
            }
    }
    $answer = " Sale :$sale , Buy : $buy";
    $bot->sendMessage($message->getChat()->getId(), $answer);

});

$bot->command('start', function ($message) use ($bot) {
    $answer = 'Добро пожаловать!';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

// команда для помощи
$bot->command('help', function ($message) use ($bot) {
    $answer = 'Команды:
/help - вывод справки';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

$bot->run();
?>
