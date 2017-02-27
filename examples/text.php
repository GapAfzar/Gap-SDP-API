<?php

require '../src/Gap.php';

$token = "";  // HERE YOUR TOKEN

$gm = new GapBot($token);

$chat_id = null;

// send text
$gm->sendText($chat_id, 'Hello world');
