<?php
class notify_system {
    public $ci;
    function __construct(){
        $this->ci =&get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function line_message_api(){
        return $this->ci;
    }
}

function notify(){
    $obj = new notify_system();
    return $obj->line_message_api();
}

function getGroupID($typeGroup){
    if($typeGroup != ""){
        $sql = notify()->db->query("SELECT
        group_id
        FROM line_groupid WHERE memo = ?
        " , array($typeGroup));

        return $sql->row()->group_id;
    }
}

function get_access_token()
{
    $sql = notify()->db->query("SELECT
    apikey
    FROM apikey WHERE id = 2
    ");

    return $sql->row()->apikey;
}

function get_link()
{
    if($_SERVER['HTTP_HOST'] == "localhost"){
        return "http://localhost/gt/";
    }else{
        return "https://gttransport.co.th/gt/";
    }
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

    return $result;
}

function send_groupAdmin_message($groupId , $messageText) {
    $access_token = get_access_token();
    $data = [
        'to' => $groupId,
        'messages' => [[
            'type' => 'text',
            'text' => $messageText
        ]]
    ];

    send_push($access_token, $data);
}

function send_user_message($useridLogin , $messageText) {
    $access_token = get_access_token();
    $data = [
        'to' => $useridLogin,
        'messages' => [[
            'type' => 'text',
            'text' => $messageText
        ]]
    ];

    send_push($access_token, $data);
}


?>