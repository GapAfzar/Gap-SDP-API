<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Gap\SDP\Api;

$token = {HERE YOUR TOKEN};

$gm = new Api($token);

$chat_id = {HERE CHAT ID};

$form = [
  ["name" => "name", "type" => "text", "label" => "Name"],
  ["name" => "married", "type" => "radio", "options" => [["y" => "Yes"], ["n" => "No"]], "label" => "Married"],
  ["name" => "city", "type" => "select", "options" => [["mah" => "Mashhad"], ["teh" => "Tehran"]], "label" => "City"],
  ["name" => "address", "type" => "textarea", "label" => "Address"],
  ["name" => "agree", "type" => "checkbox", "label" => "I agree"],
  ["type" => "submit", "label" => "Save"],
];

// send text
$gm->sendText($chat_id, 'Hello world', null, null, $form);
