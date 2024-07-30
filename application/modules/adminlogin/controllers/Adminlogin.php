<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model("adminlogin_model" , "adminlogin");
    }
    

    public function index()
    {
        $this->load->view("adminloginpage");
    }

    public function backend_checklogin()
    {
        $this->adminlogin->backend_checklogin();
    }

}

/* End of file Adminlogin.php */




?>