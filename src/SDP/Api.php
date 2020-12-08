<?php

namespace Gap\SDP;

class Api {

  protected $baseURL = 'https://api.gap.im/';

  protected $token;

  protected $lastMessage;

  public function __construct($token) {
    $this->token = $token;
    if (is_null($this->token)) {
      throw new \Exception('Required "token" key not supplied');
    }
  }

  public function getLastMessage() {
    return $this->lastMessage;
  }

  /**
   * Send Action.
   *
   * @param int            $chat_id
   * @param string         $action
   *
   * @return Array
   */
  public function sendAction($chat_id, $action) {
    $actions = array(
      'typing',
    );
    if (in_array($action, $actions)) {
      $params = compact('chat_id');
      return $this->sendRequest($action, $params, 'sendAction');
    }

    throw new \Exception('Invalid Action! Accepted value: '.implode(', ', $actions));
  }

  /**
   * Send text messages.
   *
   * @param int            $chat_id
   * @param string         $data
   * @param string         $reply_keyboard
   * @param array          $inline_keyboard
   *
   * @return Array
   */
  public function sendText($chat_id, $data, $reply_keyboard = null, $inline_keyboard = null, $form = null) {
    $params = compact('chat_id', 'data');
    if ($reply_keyboard) {
      $params['reply_keyboard'] = $reply_keyboard;
    }
    if ($inline_keyboard) {
      $params['inline_keyboard'] = json_encode($inline_keyboard);
    }
    if ($form) {
      $params['form'] = json_encode($form);
    }

    $message = $this->sendRequest('text', $params);
    return $message ? json_decode($message, true)['id'] : false;
  }

  /**
   * Send Location.
   *
   * @param int            $chat_id
   * @param float          $latitude
   * @param float          $longitude
   * @param string         $description
   * @param string         $reply_keyboard
   * @param array          $inline_keyboard
   *
   * @return Array
   */
  public function sendLocation($chat_id, $lat, $long, $desc = '', $reply_keyboard = null, $inline_keyboard = null, $form = null) {
    $data = json_encode(compact('lat', 'long', 'desc'));
    $params = compact('chat_id', 'data');
    if ($reply_keyboard) {
      $params['reply_keyboard'] = $reply_keyboard;
    }
    if ($inline_keyboard) {
      $params['inline_keyboard'] = json_encode($inline_keyboard);
    }
    if ($form) {
      $params['form'] = json_encode($form);
    }

    $message = $this->sendRequest('location', $params);
    return $message ? json_decode($message, true)['id'] : false;
  }

  /**
   * Send Contact.
   *
   * @param int            $chat_id
   * @param string         $phone
   * @param string         $name
   * @param string         $reply_keyboard
   * @param array          $inline_keyboard
   *
   * @return Array
   */
  public function sendContact($chat_id, $phone, $name, $reply_keyboard = null, $inline_keyboard = null, $form = null) {
    $data = json_encode(compact('phone', 'name'));
    $params = compact('chat_id', 'data');
    if ($reply_keyboard) {
      $params['reply_keyboard'] = $reply_keyboard;
    }
    if ($inline_keyboard) {
      $params['inline_keyboard'] = json_encode($inline_keyboard);
    }
    if ($form) {
      $params['form'] = json_encode($form);
    }

    $message = $this->sendRequest('contact', $params);
    return $message ? json_decode($message, true)['id'] : false;
  }

  /**
   * Send Image.
   *
   * @param int            $chat_id
   * @param string         $image
   * @param string         $description
   * @param string         $reply_keyboard
   * @param array          $inline_keyboard
   *
   * @return Array
   */
  public function sendImage($chat_id, $image, $desc = '', $reply_keyboard = null, $inline_keyboard = null, $form = null) {
    $msgType = 'image';
    if (!json_decode($image)) {
      if (!is_file($image)) {
        throw new \Exception("Image path is invalid");
      }
      list($msgType, $image) = $this->uploadFile('image', $image, $desc);
    }

    $params = compact('chat_id');
    $params['data'] = $image;
    if ($reply_keyboard) {
      $params['reply_keyboard'] = $reply_keyboard;
    }
    if ($inline_keyboard) {
      $params['inline_keyboard'] = json_encode($inline_keyboard);
    }
    if ($form) {
      $params['form'] = json_encode($form);
    }

    $message = $this->sendRequest($msgType, $params);
    return $message ? json_decode($message, true)['id'] : false;
  }

  /**
   * Send Audio.
   *
   * @param int             $chat_id
   * @param string          $audio
   * @param string          $description
   * @param string          $reply_keyboard
   * @param array           $inline_keyboard
   *
   * @return Array
   */
  public function sendAudio($chat_id, $audio, $desc = '', $reply_keyboard = null, $inline_keyboard = null, $form = null) {
    $msgType = 'audio';
    if (!json_decode($audio)) {
      if (!is_file($audio)) {
        throw new \Exception("Audio path is invalid");
      }
      list($msgType, $audio) = $this->uploadFile('audio', $audio, $desc);
    }

    $params = compact('chat_id');
    $params['data'] = $audio;
    if ($reply_keyboard) {
      $params['reply_keyboard'] = $reply_keyboard;
    }
    if ($inline_keyboard) {
      $params['inline_keyboard'] = json_encode($inline_keyboard);
    }
    if ($form) {
      $params['form'] = json_encode($form);
    }

    $message = $this->sendRequest($msgType, $params);
    return $message ? json_decode($message, true)['id'] : false;
  }

  /**
   * Send Video.
   *
   * @param int             $chat_id
   * @param string          $video
   * @param string          $description
   * @param string          $reply_keyboard
   * @param array           $inline_keyboard
   *
   * @return Array
   */
  public function sendVideo($chat_id, $video, $desc = '', $reply_keyboard = null, $inline_keyboard = null, $form = null) {
    $msgType = 'video';
    if (!json_decode($video)) {
      if (!is_file($video)) {
        throw new \Exception("Video path is invalid");
      }
      list($msgType, $video) = $this->uploadFile('video', $video, $desc);
    }

    $params = compact('chat_id');
    $params['data'] = $video;
    if ($reply_keyboard) {
      $params['reply_keyboard'] = $reply_keyboard;
    }
    if ($inline_keyboard) {
      $params['inline_keyboard'] = json_encode($inline_keyboard);
    }
    if ($form) {
      $params['form'] = json_encode($form);
    }

    $message = $this->sendRequest($msgType, $params);
    return $message ? json_decode($message, true)['id'] : false;
  }

  /**
   * Send File.
   *
   * @param int             $chat_id
   * @param string          $file
   * @param string          $description
   * @param string          $reply_keyboard
   * @param array           $inline_keyboard
   *
   * @return Array
   */
  public function sendFile($chat_id, $file, $desc = '', $reply_keyboard = null, $inline_keyboard = null, $form = null) {
    $msgType = 'file';
    if (!json_decode($file)) {
      if (!is_file($file)) {
        throw new \Exception("File path is invalid");
      }
      list($msgType, $file) = $this->uploadFile('file', $file, $desc);
    }

    $params = compact('chat_id');
    $params['data'] = $file;
    if ($reply_keyboard) {
      $params['reply_keyboard'] = $reply_keyboard;
    }
    if ($inline_keyboard) {
      $params['inline_keyboard'] = json_encode($inline_keyboard);
    }
    if ($form) {
      $params['form'] = json_encode($form);
    }

    $message = $this->sendRequest($msgType, $params);
    return $message ? json_decode($message, true)['id'] : false;
  }

  /**
   * Send Voice.
   *
   * @param int             $chat_id
   * @param string          $voice
   * @param string          $description
   * @param string          $reply_keyboard
   * @param array           $inline_keyboard
   *
   * @return Array
   */
  public function sendVoice($chat_id, $voice, $desc = '', $reply_keyboard = null, $inline_keyboard = null, $form = null) {
    $msgType = 'voice';
    if (!json_decode($voice)) {
      if (!is_file($voice)) {
        throw new \Exception("Voice path is invalid");
      }
      list($msgType, $voice) = $this->uploadFile('voice', $voice, $desc);
    }

    $params = compact('chat_id');
    $params['data'] = $voice;
    if ($reply_keyboard) {
      $params['reply_keyboard'] = $reply_keyboard;
    }
    if ($inline_keyboard) {
      $params['inline_keyboard'] = json_encode($inline_keyboard);
    }
    if ($form) {
      $params['form'] = json_encode($form);
    }

    $message = $this->sendRequest($msgType, $params);
    return $message ? json_decode($message, true)['id'] : false;
  }

  /**
   * Edit Message.
   *
   * @param int             $chat_id
   * @param int             $message_id
   * @param string          $data
   * @param array           $inline_keyboard
   *
   * @return Array
   */
  public function editMessage($chat_id, $message_id, $data = null, $inline_keyboard = null) {
    $params = compact('chat_id', 'message_id', 'data', 'inline_keyboard');
    if ($inline_keyboard) {
      if (!is_array($inline_keyboard)) {
        throw new \Exception("Inline keyboard is invalid");
      }
      $params['inline_keyboard'] = json_encode($inline_keyboard);
    }
    return $this->sendRequest(null, $params, 'editMessage');
  }

  /**
   * Delete Message.
   *
   * @param int             $chat_id
   * @param int             $message_id
   *
   * @return Array
   */
  public function deleteMessage($chat_id, $message_id) {
    $params = compact('chat_id', 'message_id');
    return $this->sendRequest(null, $params, 'deleteMessage');
  }

  /**
   * Answer Callback.
   *
   * @param int             $chat_id
   * @param int             $callback_id
   * @param string          $text
   * @param bool            $show_alert
   *
   * @return Array
   */
  public function answerCallback($chat_id, $callback_id, $text, $show_alert = false) {
    $params = compact('chat_id', 'callback_id', 'text', 'show_alert');
    if ($show_alert) {
      $params['show_alert'] = 'true';
    } else {
      $params['show_alert'] = 'false';
    }
    return $this->sendRequest(null, $params, 'answerCallback');
  }

  /**
   * Send Invoice.
   *
   * @param int             $chat_id
   * @param int             $amount
   * @param string          $description
   * @param string          $currency
   *
   * @return string
   */
  public function sendInvoice($chat_id, $amount, $description, $expire_date='', $currency = 'IRR') {
    $expire_date = (is_numeric($expire_date) && (int) $expire_date == $expire_date && $expire_date >= 300 && $expire_date <= 604800) ? $expire_date : 86400;
    $params = compact('chat_id', 'amount', 'description', 'expire_date', 'currency');
    $result = $this->sendRequest('text', $params, 'invoice');
    $result = json_decode($result, true);
    return $result['id'];
  }

    /**
   * Send Image Invoice.
   *
   * @param int             $chat_id
   * @param int             $amount
   * @param string          $image
   * @param string          $description
   * @param string          $currency
   *
   * @return string
   */
  public function sendImageInvoice($chat_id, $amount, $image, $description, $expire_date='', $currency = 'IRR') {

    $msgType = 'image';
    if (!json_decode($image)) {
      if (!is_file($image)) {
        throw new \Exception("Image path is invalid");
      }
      list($msgType, $image) = $this->uploadFile('image', $image, $description);
    }
    $expire_date = (is_numeric($expire_date) && (int) $expire_date == $expire_date && $expire_date >= 300 && $expire_date <= 604800) ? $expire_date : 86400;
    $params = compact('chat_id', 'amount', 'currency', 'expire_date');
    $params['image'] = $image;

    $result = $this->sendRequest($msgType, $params, 'invoice');
    $result = json_decode($result, true);
    return $result['id'];
  }


  /**
   * Invoice inquiry.
   *
   * @param int             $chat_id
   * @param int             $ref_id (invoiceId)
   *
   * @return array
   */
  public function invoiceInquiry($chat_id, $ref_id) {
    $params = compact('chat_id', 'ref_id');
    $result = $this->sendRequest(null, $params, 'invoice/inquiry');
    $result = json_decode($result, true);
    if (is_array($result)) {
      return $result;
    }
  }

  /**
   * Invoice verify.
   *
   * @param int             $chat_id
   * @param int             $ref_id (invoiceId)
   *
   * @return array
   */
  public function invoiceVerify($chat_id, $ref_id) {
    $params = compact('chat_id', 'ref_id');
    $result = $this->sendRequest(null, $params, 'invoice/verify');
    $result = json_decode($result, true);
    return is_array($result) && $result['status'] == 'verified';
  }

  /**
   * Pay verify.
   *
   * @param int             $chat_id
   * @param int             $ref_id
   *
   * @return bool
   */
  public function payVerify($chat_id, $ref_id) {
    $params = compact('chat_id', 'ref_id');
    $result = $this->sendRequest(null, $params, 'payment/verify');
    $result = json_decode($result, true);
    return is_array($result) && $result['status'] == 'verified';
  }

  /**
   * Pay inquiry.
   *
   * @param int             $chat_id
   * @param int             $ref_id
   *
   * @return array
   */
  public function payInquiry($chat_id, $ref_id) {
    $params = compact('chat_id', 'ref_id');
    $result = $this->sendRequest(null, $params, 'payment/inquiry');
    $result = json_decode($result, true);
    if (is_array($result)) {
      return $result;
    }
  }

  /**
   * Request wallet charge.
   *
   * @param int             $chat_id
   * @param int             $ref_id
   *
   * @return bool
   */
  public function requestWalletCharge($chat_id, $desc = null) {
    $params = compact('chat_id', 'desc');
    return $this->sendRequest(null, $params, 'requestWalletCharge');
  }

  /**
   * Reply keyboard.
   *
   * @param array        $keyboard
   * @param bool         $once
   * @param bool         $selective
   *
   * @return String
   */
  public function replyKeyboard($keyboard, $once = true, $selective = false) {
    if (!is_array($keyboard)) {
      throw new \Exception("keyboard must be array");
    }
    $replyKeyboard = compact('keyboard', 'once', 'selective');
    return json_encode($replyKeyboard);
  }

  /**
   * Get Game Data.
   *
   * @param int $chat_id
   * @param string $type
   *
   * @return mixed
   * @throws \Exception
   */
  public function getGameData($chat_id, $type) {
    $params = compact('chat_id', 'type');
    $result = $this->sendRequest(null, $params, 'getGameData');
    return $result ? json_decode($result, true)['data'] : false;
  }

  /**
   * Set Game Data.
   *
   * @param int $chat_id
   * @param string $type
   * @param string $data
   * @param bool $force
   *
   * @return mixed
   * @throws \Exception
   */
  public function setGameData($chat_id, $type, $data, $force = false) {
    $params = compact('chat_id', 'type', 'data', 'force');
    return $this->sendRequest(null, $params, 'gameData');
  }

  /**
   * Get Game Config.
   *
   * @param int $chat_id
   * @param string $key
   *
   * @return mixed
   * @throws \Exception
   */
  public function getGameConfig($chat_id, $key = null){
    $params = compact('chat_id', 'key');
    $result = $this->sendRequest(null, $params, 'getGameConfig');
    return $result ? json_decode($result, true)['configs'] : false;
  }

  /**
   * Game Event.
   *
   * @param int $chat_id
   * @param string $event
   * @param string $value
   *
   * @return mixed
   * @throws \Exception
   */
  public function gameEvent($chat_id, $event, $value){
    if (empty($event)) {
      throw new \Exception('Event required!');
    }
    if (empty($value)) {
      throw new \Exception('Value required!');
    }
    $params = compact('chat_id', 'event', 'value');
    return $this->sendRequest(null, $params, 'gameEvent');
  }

  /**
   * Leader Board.
   *
   * @param int $chat_id
   * @param string $type
   *
   * @return mixed
   * @throws \Exception
   */
  public function leaderBoard($chat_id, $type = 'all') {
    $types = array(
      'all',
      'month',
      'week',
      'day'
    );
    if(!in_array($type, $types)){
      throw new \Exception('Invalid Type! Accepted value: '.implode(', ', $types));
    }
    $params = compact('chat_id', 'type');
    $result = $this->sendRequest(null, $params, 'leaderBoard');
    return $result ? json_decode($result, true) : false;
  }

  private function sendRequest($msgType, $params, $method = 'sendMessage') {
    if ($msgType) {
      $params['type'] = $msgType;
    }

    if ($method == 'sendMessage') {
      $this->lastMessage = $params;
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $this->baseURL . $method);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('token: ' . $this->token));

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_result = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($httpcode != 200) {
      if ($curl_result) {
        $curl_result = json_decode($curl_result, true);
        throw new \Exception($curl_result['error']);
      }
      throw new \Exception('an error was encountered');
    }

    return $curl_result;
  }

  private function uploadFile($type, $file, $desc) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file);
    $data[$type] = new \CurlFile($file, $mime_type, basename($file));

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->baseURL . 'upload');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('token: ' . $this->token));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $uploaded = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $decoded = json_decode($uploaded, true);
    if ($httpcode != 200 || json_last_error()) {
      throw new \Exception('upload an error was encountered');
    }
    $decoded['desc'] = $desc;
    return [$decoded['type'], json_encode($decoded)];
  }
}
