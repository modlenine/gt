<?php
class Onload
{
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
    }



    ////////////////////////////////////////////////////////////////
    /////////////// CHECK LOGIN HOOK ทำงานในระดับบนสุด
    ///////////////////////////////////////////////////////////////
    public function checklogin()
    {
        $controller = $this->ci->router->class;
        $method = $this->ci->router->method;
        $checkpage = $this->ci->uri->segment(1);

        $browserUser = $this->ci->agent->browser();
        if($browserUser == "Internet Explorer"){
            echo "<script>";
            echo "alert('โปรแกรมไม่ Support Internet Explorer กรุณาเข้าใช้งานโปรแกรมด้วย Browser อื่น เช่น Google chrome , Firefox , Safari')";
            echo "</script>";
            die();
        }else{
            if($checkpage != "backend" && $checkpage != "adminlogin"){
                if ($this->ci->session->userdata("userId") == "") {
                    if ($controller != "login") {
                        $_SESSION['RedirectKe'] = $_SERVER['REQUEST_URI'];
                        header("refresh:0; url=" . base_url('login'));
                        exit();
                    }
                }
            }else if($checkpage == "backend"){
                if ($this->ci->session->userdata("am_username") == "") {
                    if ($controller != "adminlogin") {
                        $_SESSION['RedirectKe'] = $_SERVER['REQUEST_URI'];
                        header("refresh:0; url=" . base_url('adminlogin'));
                        exit();
                    }
                }
            }
        }

    

    }

    ////////////////////////////////////////////////////////////////
    /////////////// CHECK LOGIN HOOK ทำงานในระดับบนสุด
    ///////////////////////////////////////////////////////////////








}//End onload Class
