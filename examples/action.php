<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Gap\SDP\Api;

$token = {HERE YOUR TOKEN};

$gm = new Api($token);

$chat_id = {HERE CHAT ID};

// send typing
$gm->sendAction($chat_id, 'typing');
