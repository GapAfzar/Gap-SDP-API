<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Gap\SDP\Api;

$token = {HERE YOUR TOKEN};

$gm = new Api($token);

$chat_id = {HERE CHAT ID};

$replyKeyboard = $gm->replyKeyboard([[['yes' => 'Yes'], ['no' => 'No']], [['cancel' => 'Cancel']]]);

// send text
$gm->sendText($chat_id, 'Hello world', $replyKeyboard);
