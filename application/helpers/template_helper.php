<?php
class template_fn{
    private $ci;
    function __construct()
    {
        $this->ci =&get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    function templatefn()
    {
        return $this->ci;
    }
}


function tempfn()
{
    $obj = new template_fn();
    return $obj->templatefn();
}


function getHead()
{
    return tempfn()->load->view("templates/head");
}
function getFooter()
{
    return tempfn()->load->view("templates/footer");
}
function getContent($page , $data)
{
    return tempfn()->load->view($page , $data);
}
function getModal($modal)
{
    return tempfn()->load->view($modal);
}


function sendLineNotify($message, $token) {
    $url = 'https://notify-api.line.me/api/notify';
    $data = [
        'message' => $message
    ];
    $headers = [
        'Content-Type: multipart/form-data',
        'Authorization: Bearer ' . $token
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}



?>