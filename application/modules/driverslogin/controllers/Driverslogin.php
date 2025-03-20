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

    public function drivers_checklogin()
    {
        $this->driverslogin->drivers_checklogin();
    }

    public function driver_logout()
    {
        $this->driverslogin->drivers_logout();
    }

    public function register()
    {
        $this->load->view("drivers_register");
    }

    public function uploadFile_mem_doc1()
    {
        $this->driverslogin->uploadFile_mem_doc1();
    }

    public function removeFile_mem_doc1()
    {
        $this->driverslogin->removeFile_mem_doc1();
    }

    public function uploadFile_mem_doc2()
    {
        $this->driverslogin->uploadFile_mem_doc2();
    }

    public function removeFile_mem_doc2()
    {
        $this->driverslogin->removeFile_mem_doc2();
    }

    public function uploadFile_mem_doc3()
    {
        $this->driverslogin->uploadFile_mem_doc3();
    }

    public function removeFile_mem_doc3()
    {
        $this->driverslogin->removeFile_mem_doc3();
    }

    public function uploadFile_mem_doc4()
    {
        $this->driverslogin->uploadFile_mem_doc4();
    }

    public function removeFile_mem_doc4()
    {
        $this->driverslogin->removeFile_mem_doc4();
    }

    public function saveRegisterAccept()
    {
        $this->driverslogin->saveRegisterAccept();
    }

}

/* End of file Adminlogin.php */




?>