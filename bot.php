<?php
require_once "vendor/autoload.php";
$token = "982221383:AAEgNznDDyQdYXeC_6eoO33jZ3mXDE_YM88";
$bot = new \TelegramBot\Api\Client($token);
$json = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
$obj = json_decode($json);
date_default_timezone_set('Ukraine/Kiev'); // CDT

$current_date = date('d/m/Y');


$bot = new \TelegramBot\Api\BotApi('982221383:AAEgNznDDyQdYXeC_6eoO33jZ3mXDE_YM88');

$keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("one", "two", "three")), true); // true for one-time keyboard

$bot->sendMessage($chatId, $messageText, null, false, null, $keyboard);
?>
