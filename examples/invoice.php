<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Gap\SDP\Api;

$token = {HERE YOUR TOKEN};

$gm = new Api($token);

$chat_id = {HERE CHAT ID};

// send invoice
$invoiceId = $gm->sendInvoice($chat_id, 1000, 'My Invoice Description...',1616314703);
