<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model("main_model" , "main");
        
    }

    public function testcode()
    {
        getGroupID("Driver Group");
    }
    

    public function index()
    {
        $this->load->view("templates/head");
        $this->load->view("index");
        $this->load->view("templates/footer");
    }

    public function gt_service()
    {
        $this->load->view("templates/head");
        $this->load->view("gt_servicepage");
        $this->load->view("templates/footer");
    }

    public function getDistanceRate()
    {
        $this->main->getDistanceRate();
    }

    public function saveSendtoApprove()
    {
        $this->main->saveSendtoApprove();
    }

    public function requestList()
    {
        $this->load->view("templates/head");
        $this->load->view("request_list");
        $this->load->view("templates/footer");
    }

    public function get_requestList()
    {
        $this->main->get_requestList();
    }

    public function request_viewfull_page($formno , $userid)
    {
        if(!empty($formno)){
            $queryViewfull = $this->main->get_viewfulldata_topage($formno , $userid);
            $data = array(
                "title" => "หน้ารายการรอโอนเงินมัดจำ",
                "formno" => $formno ,
                "dataviewfull" => $queryViewfull->row()
            );
            $this->load->view("templates/head");
            $this->load->view("request_viewfull" , $data);
            $this->load->view("templates/footer");
        }
    }

    public function uploadFile_confirmPay()
    {
        $this->main->uploadFile_confirmPay();
    }

    public function remove_confirmPay()
    {
        $this->main->remove_confirmPay();
    }

    public function removeTempFile_byuser()
    {
        $this->main->removeTempFile_byuser();
    }

    public function saveConfirmPay()
    {
        $this->main->saveConfirmPay();
    }

    public function getDataConfirmPay()
    {
        $this->main->getDataConfirmPay();
    }

    public function getDriverGetjobData()
    {
        $this->main->getDriverGetjobData();
    }

    public function getDriverCheckinData()
    {
        $this->main->getDriverCheckinData();
    }

    public function getDriverStartJobData()
    {
        $this->main->getDriverStartJobData();
    }

    public function getDriverCheckinDesData()
    {
        $this->main->getDriverCheckinDesData();
    }

    public function getDriverStopJobData()
    {
        $this->main->getDriverStopJobData();
    }

    public function getPricerate()
    {
        $this->main->getPricerate();
    }



}/* End of file Main.php */
?>