<?php
require_once "vendor/autoload.php";
$token = "982221383:AAEgNznDDyQdYXeC_6eoO33jZ3mXDE_YM88";
$bot = new \TelegramBot\Api\Client($token);


$json = file_get_contents('https://api.privatbank.ua/p24api/exchange_rates?json&date=06.10.2019');
$obj = json_decode($json);

foreach ($json as $item) {

    if ($item->currency == 'USD') {
        $sale = $item->saleRate;
        $buy = $item->purchaseRate;
        $bot->command('USD', function ($message, $sale, $buy) use ($bot) {

            $answer = " Sale :$sale , Buy : $buy";
            $bot->sendMessage($message->getChat()->getId(), $answer);
        });
    }
}

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
