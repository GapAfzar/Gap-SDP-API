<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Gap\SDP\Api;

$token = {HERE YOUR TOKEN};

$gm = new Api($token);

$chat_id = {HERE CHAT ID};

// send text
$gm->sendText($chat_id, 'Hello world', null, [
	[
		[
			"text" => "click",
			"cb_data" => "c_1"
		]
	],
	[
		[
			"text" => "google",
			"url" => "http://google.com"
		]
	],
]);
