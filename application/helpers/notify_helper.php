<?php
class notify {
    public $ci;
    function __construct(){
        $this->ci =&get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function telenotify(){
        return $this->ci;
    }
}

function notify(){
    $obj = new telegram_notify();
    return $obj->telenotify();
}

function send_notify($token , $chat_id , $message){
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = [
        'chat_id' => $chat_id, 
        'text' => $message,
        'parse_mode' => 'HTML' // หรือใช้ 'MarkdownV2' ได้เช่นกัน
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}


//Line Notify
function send_push($access_token, $data) {
    $ch = curl_init('https://api.line.me/v2/bot/message/push');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $result = curl_exec($ch);
    curl_close($ch);

    echo 'Result: ' . $result;
}

function send_groupDriver_message() {
    $access_token = 'dDiguBtWimRCvUb05YlBeViLUeO55TEOTuXS1DRoCRi/I3hB7N9cW4RcpAIuOtrt9TV/cAvMgllhusDfRjYjFE8fuzvM97Bu7UaEnXF4V2HWcmBzewELGu8I/eDsdM/jZYa/iR/cm7i/isRMkzpAwQdB04t89/1O/w1cDnyilFU=';
    $groupId = 'C777a61c12e85b02ac05e7f5efa48f636';

    $messageText = "📣 มีงานใหม่รอรับงาน!\nกดดูรายละเอียดที่นี่:\nhttps://yourdomain.com/announcement/123";

    $data = [
        'to' => $groupId,
        'messages' => [[
            'type' => 'text',
            'text' => $messageText
        ]]
    ];

    send_push($access_token, $data);
}


?>