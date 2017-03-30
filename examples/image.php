<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Gap\SDP\Api;

$token = "";  // HERE YOUR TOKEN

$gm = new Api($token);

$chat_id = null;

$replyKeyboard = $gm->replyKeyboard([[['yes' => 'Like'], ['no' => 'unLike']], [['cancel' => 'Cancel']]]);

// send image
$gm->sendImage($chat_id, 'pic.jpg', 'Image caption', $replyKeyboard);