<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Linemessage extends MX_Controller {

    public function send_groupDriver_message() {
        send_groupDriver_message();
    }

    // ฟังก์ชันส่งข้อความ
    // private function _send_push($access_token, $data) {
    //     $ch = curl_init('https://api.line.me/v2/bot/message/push');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //         'Content-Type: application/json',
    //         'Authorization: Bearer ' . $access_token
    //     ]);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    //     $result = curl_exec($ch);
    //     curl_close($ch);

    //     echo 'Result: ' . $result;
    // }

}

/* End of file Controllername.php */
?>
