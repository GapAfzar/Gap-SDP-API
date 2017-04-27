<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Gap\SDP\Api;

$token = {HERE YOUR TOKEN};

$gm = new Api($token);

$chat_id = {HERE CHAT ID};
$message_id = {HERE MESSAGE ID};

// edit text
$gm->editMessage($chat_id, $message_id, 'Hello world Again');
