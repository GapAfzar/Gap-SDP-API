<?php

require '../src/Gap.php';

$token = "";  // HERE YOUR TOKEN

$gm = new GapBot($token);

$chat_id = null;

// send typing
$gm->sendAction($chat_id, 'typing');
