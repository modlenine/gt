<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Driverslogin extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model("driverslogin_model" , "driverslogin");
    }
    

    public function index()
    {
        $this->load->view("driversloginpage");
    }

    public function backend_checklogin()
    {
        $this->adminlogin->backend_checklogin();
    }

}

/* End of file Adminlogin.php */




?>