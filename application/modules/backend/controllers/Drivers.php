<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model("drivers_model" , "drivers");
    }
    

    public function index()
    {
        $this->load->view("templates/drivers/head");
        $this->load->view("drivers_page/index");
        $this->load->view("templates/drivers/footer");
    }

    public function job_list_page($param)
    {
        $destext = "";
        if($param == "job_avaliable"){
            $destext = "รอรับงาน";
        }
        $data = array(
            "title" => "",
            "param" => $param ,
            "description_param" => "$destext"
        );
        $this->load->view("templates/drivers/head");
        $this->load->view("drivers_page/jobs_list" , $data);
        $this->load->view("templates/drivers/footer");
    }

    public function request_job_list($param)
    {
        if(!empty($param)){
            //code
            if($param == "job_avaliable"){
                $this->drivers->request_job_list_avaliable();
            }else if($param == "job_pending"){
                $this->drivers->request_job_list_pending();
            }
        }
    }

    public function request_viewfull_page($formno)
    {
        if(!empty($formno)){
            $queryViewfull = $this->drivers->get_viewfulldata_topage($formno);
            $data = array(
                "title" => "หน้ารายการรอ แอดมิน ตรวจสอบข้อมูล",
                "formno" => $formno ,
                "dataviewfull" => $queryViewfull->row()
            );
            $this->load->view("templates/drivers/head");
            $this->load->view("drivers_page/requestJob_viewfull" , $data);
            $this->load->view("templates/drivers/footer");
        }
    }

    public function getJob()
    {
        $this->drivers->getJob();
    }

    public function getExpireTime()
    {
        $this->drivers->getExpireTime();
    }

    public function getJobTimeout()
    {
        $this->drivers->getJobTimeout();
    }

    public function jl_checkExpireTime()
    {
        $this->drivers->jl_checkExpireTime();
    }

    public function checkin()
    {
        $this->drivers->checkin();
    }

    public function getCheckInData()
    {
        $this->drivers->getCheckInData();
    }

    //File function 
    public function uploadFile_start()
    {
        $this->drivers->uploadFile_start();
    }

    public function removeFile_start()
    {
        $this->drivers->removeFile_start();
    }

    public function saveStart()
    {
        $this->drivers->saveStart();
    }

    public function getStartJobData()
    {
        $this->drivers->getStartJobData();
    }

}

/* End of file Controllername.php */
?>