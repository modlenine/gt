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
    public function checklogin()
    {

        if ($_POST['username'] != "" && $_POST['password'] != "") {

            $user = mysqli_real_escape_string($this->escape_string(), $_POST['username']);
            $pass = mysqli_real_escape_string($this->escape_string(), $_POST['password']);
            // If System go on Please add md5 to element name password 'md5'

            $checkuser = $this->db->query(sprintf("SELECT * FROM member WHERE mem_username = '%s' and mem_password = '%s'  ", $user, $pass));
            $checkdata = $checkuser->num_rows();


            if ($checkdata == 0) {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert" style="font-size:15px;text-align: center;">ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง</div>');
                redirect('login');
                die();
            } else {

                $_SESSION['username'] = $checkuser->row()->mem_username;
                $_SESSION['fname'] = $checkuser->row()->mem_fname;
                $_SESSION['lname'] = $checkuser->row()->mem_lname;
                $_SESSION['lineid'] = $checkuser->row()->mem_lineid;
                $_SESSION['tel'] = $checkuser->row()->mem_tel;
                $_SESSION['email'] = $checkuser->row()->mem_email;
                $_SESSION['cusid'] = $checkuser->row()->mem_autoid;

                // insert login log
                session_write_close();

                $uri = isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe'] : '/gt';
                header('location:' . $uri);
                // header("refresh:0; url=" . base_url());

            }

        }
    } //End checklogin







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
