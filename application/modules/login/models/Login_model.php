<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        date_default_timezone_set("Asia/bangkok");
    }


    private function escape_string()
    {
        if($_SERVER['HTTP_HOST'] == "localhost"){
            return mysqli_connect("localhost", "ant", "Ant1234", "gt");
        }else{
            return mysqli_connect("localhost", "ant", "Ant1234", "gt");
        }

    }


    //Start checklogin method
    public function checklogin($userId)
    {

        if (!empty($userId)) {

            $checkuser = $this->db->query("SELECT
            mem_line_userId,
            mem_line_displayName,
            mem_line_pictureUrl,
            mem_line_accesstoken,
            mem_fname,
            mem_lname,
            mem_tel,
            mem_status
            FROM member WHERE mem_line_userId = '$userId'
            ");
            

            if($checkuser->num_rows() > 0){

                $_SESSION['userId'] = $checkuser->row()->mem_line_userId;
                $_SESSION['displayName'] = $checkuser->row()->mem_line_displayName;
                $_SESSION['pictureUrl'] = $checkuser->row()->mem_line_pictureUrl;
                $_SESSION['fullname'] = $checkuser->row()->mem_fname." ".$checkuser->row()->mem_lname;
                $_SESSION['tel'] = $checkuser->row()->mem_tel;
                $_SESSION['accesstoken'] = $checkuser->row()->mem_line_accesstoken;
                // insert login log
                session_write_close();

                return $checkuser->row()->mem_status;
            }else{
                return "Not Have Data";
            }

        }
    } //End checklogin

    public function saveSignup()
    {
        if(!empty($this->input->post('mem_line_userId')) && !empty($this->input->post("mem_fname")) && !empty($this->input->post("mem_lname")) && !empty($this->input->post("mem_tel"))){
            $arsave = array(
                "mem_line_userId" => $this->input->post("mem_line_userId"),
                "mem_line_displayName" => $this->input->post("mem_line_displayName"),
                "mem_line_pictureUrl" => $this->input->post("mem_line_pictureUrl"),
                "mem_fname" => $this->input->post("mem_fname"),
                "mem_lname" => $this->input->post("mem_lname"),
                "mem_tel" => $this->input->post("mem_tel"),
                "mem_datetime" => date("Y-m-d H:i:s"),
                "mem_status" => "Wait Allow Notify"
            );

            $this->db->insert("member" , $arsave);

            $_SESSION['userId'] = $this->input->post("mem_line_userId");
            $_SESSION['displayName'] = $this->input->post("mem_line_displayName");
            $_SESSION['pictureUrl'] = $this->input->post("mem_line_pictureUrl");
            $_SESSION['fullname'] = $this->input->post("mem_fname")." ".$this->input->post("mem_lname");
            $_SESSION['tel'] = $this->input->post("mem_tel");

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Insert Data Success",
                "mem_line_userId" => $this->input->post("mem_line_userId")
            );
        }else{
            $output = array(
                "msg" => "บันทึกข้อมูลไม่สำเร็จ",
                "status" => "Insert Data Not Success",

            );
        }

        echo json_encode($output);
    }







    public function logout()
    {
        session_destroy();
        $this->session->unset_userdata('referrer_url');
        header("refresh:0; url=" . base_url());
        die();
    }



    public function getuser()
    {
        $sessionUsername = $_SESSION['username'];
        if($sessionUsername != ""){
            $sql = $this->db->query("SELECT * FROM member WHERE mem_username = '$sessionUsername'");
            return $sql->row();
        }else{
            return '';
        }
        
    }


    public function callLogin()
    {
        $controller = $this->router->class;
        if ($this->session->userdata("username") == "") {
            if ($controller != "login") {
                $_SESSION['RedirectKe'] = $_SERVER['REQUEST_URI'];
                header("refresh:0; url=" . base_url('login'));
                exit();
            }
        }else{
            $uri = isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe'] : '/gt';
            header('location:' . $uri);
        }
    }




    
}/* End of file ModelName.php */
