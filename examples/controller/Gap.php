<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gap extends CI_Controller
{
    private $gap_token;

    public function __construct()
    {
        parent::__construct();
        $this->gap_token = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"; // Your Gap API Token
    }

    function index()
    {
        //------------------------------------------- Gap Messenger --------------------------------------//
        $chat_id = "XXXXX"; // Chat id or Phone number +989...
        include APPPATH . 'third_party/GAP/GapApi.php';
        $gap = new GapMessenger\GapApi($this->gap_token);

        $replyKeyboard = $gap->replyKeyboard([[['yes' => 'Yes'], ['no' => 'No']], [['cancel' => 'Cancel']]]);
        // send text
        $gap->sendText($chat_id, 'Hello world', $replyKeyboard);
        //------------------------------------------- Gap Messanger --------------------------------------//


    }

}
