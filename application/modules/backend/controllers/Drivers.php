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
        }else if($param == "job_pending"){
            $destext = "กำลังดำเนินการ";
        }else if($param == "job_close"){
            $destext = "ดำเนินการเสร็จสิ้น";
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
            }else if($param == "job_close"){
                $this->drivers->request_job_list_close();
            }
        }
    }

    public function request_viewfull_page($formno)
    {
        if(!empty($formno)){
            if($this->drivers->checkJobProgress($formno) == true){
                $queryViewfull = $this->drivers->get_viewfulldata_topage($formno);
                $data = array(
                    "title" => "หน้ารายการรอ แอดมิน ตรวจสอบข้อมูล",
                    "formno" => $formno ,
                    "dataviewfull" => $queryViewfull->row()
                );
                $this->load->view("templates/drivers/head");
                $this->load->view("drivers_page/requestJob_viewfull" , $data);
                $this->load->view("templates/drivers/footer");
            }else{
                $this->load->view("drivers_page/errorpage");
            }
        }
    }

    public function clearDataTempByUser()
    {
        $this->drivers->clearDataTempByUser();
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

    public function checkinDes()
    {
        $this->drivers->checkinDes();
    }

    public function getCheckInData()
    {
        $this->drivers->getCheckInData();
    }

    public function getCheckInDataDes()
    {
        $this->drivers->getCheckInDataDes();
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

    //File function 
    public function uploadFile_stop()
    {
        $this->drivers->uploadFile_stop();
    }

    public function removeFile_stop()
    {
        $this->drivers->removeFile_stop();
    }

    public function saveStop()
    {
        $this->drivers->saveStop();
    }

    public function getStopJobData()
    {
        $this->drivers->getStopJobData();
    }

}

/* End of file Controllername.php */
?>