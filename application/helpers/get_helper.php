<?php
class getfn
{
    private $ci;
    function __construct()
    {
        $this->ci = &get_instance();
        date_default_timezone_set("Asia/Bangkok");
    }

    function gci()
    {
        return $this->ci;
    }
}



function get()
{
    $obj = new getfn();
    return $obj->gci();
}



function getDatabase()
{
    $sql = get()->db->query("SELECT * FROM db WHERE db_active = 'active' ");
    return $sql->row();
}

// Get Main form no
function getFormNo()
{
    // check formno ซ้ำในระบบ
    $checkRowdata = get()->db->query("SELECT
    m_formno FROM main ORDER BY m_autoid DESC LIMIT 1 
    ");
    $result = $checkRowdata->num_rows();

    $cutYear = substr(date("Y"), 2, 2);
    $getMonth = substr(date("m"), 0, 2);
    $formno = "";
    if ($result == 0) {
        $formno = "GTT" . $cutYear.$getMonth. "000001";
    } else {

        $getFormno = $checkRowdata->row()->m_formno;
        $cutGetYear = substr($getFormno, 3, 2); //KB2003001
        $cutNo = substr($getFormno, 7, 6); //อันนี้ตัดเอามาแค่ตัวเลขจาก CRF2003001 ตัดเหลือ 001
        $cutNo++;

        if ($cutNo < 10) {
            $cutNo = "00000" . $cutNo;
        } else if ($cutNo < 100) {
            $cutNo = "0000" . $cutNo;
        }else if($cutNo < 1000){
            $cutNo = "000" . $cutNo;
        }else if($cutNo < 10000){
            $cutNo = "00" . $cutNo;
        }else if($cutNo < 100000){
            $cutNo = "0" . $cutNo;
        }

        if ($cutGetYear != $cutYear) {
            $formno = "GTT" . $cutYear.$getMonth."000001";
        } else {
            $formno = "GTT" . $cutGetYear.$getMonth. $cutNo;
        }
    }

    return $formno;
}

function getRegisNo()
{
    // check formno ซ้ำในระบบ
    $checkRowdata = get()->db->query("SELECT
    regis_no FROM register_no_autorun ORDER BY autoid DESC LIMIT 1 
    ");
    $result = $checkRowdata->num_rows();

    $cutYear = substr(date("Y"), 2, 2);
    $getMonth = substr(date("m"), 0, 2);
    $formno = "";
    if ($result == 0) {
        $formno = "REG" . $cutYear.$getMonth. "000001";
    } else {

        $getFormno = $checkRowdata->row()->m_formno;
        $cutGetYear = substr($getFormno, 3, 2); //KB2003001
        $cutNo = substr($getFormno, 7, 6); //อันนี้ตัดเอามาแค่ตัวเลขจาก CRF2003001 ตัดเหลือ 001
        $cutNo++;

        if ($cutNo < 10) {
            $cutNo = "00000" . $cutNo;
        } else if ($cutNo < 100) {
            $cutNo = "0000" . $cutNo;
        }else if($cutNo < 1000){
            $cutNo = "000" . $cutNo;
        }else if($cutNo < 10000){
            $cutNo = "00" . $cutNo;
        }else if($cutNo < 100000){
            $cutNo = "0" . $cutNo;
        }

        if ($cutGetYear != $cutYear) {
            $formno = "REG" . $cutYear.$getMonth."000001";
        } else {
            $formno = "REG" . $cutGetYear.$getMonth. $cutNo;
        }
    }

    return $formno;
}

function getAdmintoken()
{
    $sql = get()->db->query("SELECT t_token FROM token_master WHERE t_autoid =1");
    return $sql->row();
}

function getDb()
{
    $sql = get()->db->query("SELECT
    db_host,
    db_name,
    db_username,
    db_password
    FROM db
    ");

    return $sql->row();
}

function get_urlcallback($cb_name)
{
    $condition = "";
    if($cb_name == "เข้าสู่ระบบ"){
        if($_SERVER['HTTP_HOST'] == "localhost"){
            $condition = "WHERE cb_autoid = '2'";
        }else{
            $condition = "WHERE cb_autoid = '1'";
        }
    }else if($cb_name == "การแจ้งเตือนผ่านไลน์"){
        if($_SERVER['HTTP_HOST'] == "localhost"){
            $condition = "WHERE cb_autoid = '3'";
        }else{
            $condition = "WHERE cb_autoid = '4'";
        }
    }

    $sql = get()->db->query("SELECT
    cb_url_callback,
    cb_client_id,
    cb_client_secret,
    cb_channel_id,
    cb_channel_secret
    FROM callback_url $condition
    ");

    return $sql->row();

}

function get_googlemap_apikey()
{
    $sql = get()->db->query("SELECT
    apikey
    FROM apikey
    ");

    return $sql->row()->apikey;
}

function getDriverData($username)
{
    if(!empty($username)){
        $sql = get()->db->query("SELECT * FROM member_drivers WHERE dv_username = ?" , array($username));
        if($sql->num_rows() > 0){
            return $sql->row();
        }else{
            return false;
        }
    }
}












?>