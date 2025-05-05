<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model("admin_model" , "admin");
    }
    

    public function index()
    {
        $this->load->view("templates/admin/head");
        $this->load->view("index");
        $this->load->view("templates/admin/footer");
    }

    public function request_list_page($param)
    {
        $data = array(
            'param' => $param
        );
        $this->load->view("templates/admin/head");
        $this->load->view("request_list" , $data);
        $this->load->view("templates/admin/footer");
    }

    public function request_list_table($status)
    {
        if(!empty($status)){
            if($status == "data"){
                $this->admin->request_list_checkdata();
            }else if($status == "checkpayment"){
                $this->admin->request_list_checkpayment();
            }else if($status == "paymented"){
                $this->admin->request_list_checkpaymented();
            }else if($status == "driver_get_job"){
                $this->admin->request_list_drivergetjob();
            }
        }
    }

    public function request_viewfull_page($formno)
    {
        if(!empty($formno)){
            $queryViewfull = $this->admin->get_viewfulldata_topage($formno);
            $data = array(
                "title" => "หน้ารายการรอ แอดมิน ตรวจสอบข้อมูล",
                "formno" => $formno ,
                "dataviewfull" => $queryViewfull->row()
            );
            $this->load->view("templates/admin/head");
            $this->load->view("request_viewfull" , $data);
            $this->load->view("templates/admin/footer");
        }
    }

    public function saveApproveDoc()
    {
        $this->admin->saveApproveDoc();
    }

    public function getDataApproved()
    {
        $this->admin->getDataApproved();
    }

    public function getDataConfirmPay()
    {
        $this->admin->getDataConfirmPay();
    }

    public function saveConfirmPayChecked()
    {
        $this->admin->saveConfirmPayChecked();
    }

    public function getDataConfirmPayChecked()
    {
        $this->admin->getDataConfirmPayChecked();
    }

    public function getCheckInData()
    {
        $this->admin->getCheckInData();
    }

    public function getStartJobData()
    {
        $this->admin->getStartJobData();
    }

    public function getCheckInDataDes()
    {
        $this->admin->getCheckInDataDes();
    }

    public function getStopJobData()
    {
        $this->admin->getStopJobData();
    }

    public function register_list_page($type)
    {
        $data = array(
            'title' => "Register list page",
            'listtype' => $type
        );
        $this->load->view("templates/admin/head");
        $this->load->view("register_list" , $data);
        $this->load->view("templates/admin/footer");
    }

    public function load_register_list($type)
    {
        if($type == "waitapprove"){
            $this->admin->load_register_list_waitapprove();
        }else if($type == "active"){
            $this->admin->load_register_list_active();
        }else if($type == "notapprove"){
            $this->admin->load_register_list_notapprove();
        }
    }

    public function register_viewfull($registerNo)
    {
        $registerData = $this->admin->get_registerdata_viewfull($registerNo);
        $data = array(
            "title" => "Register viewfull page",
            "registerData" => $registerData,
            "registerNo" => $registerNo
        );
        $this->load->view("templates/admin/head");
        $this->load->view("register_viewfull" , $data);
        $this->load->view("templates/admin/footer");
    }

    public function getRegisterData()
    {
        $this->admin->getRegisterData();
    }

    public function saveRegisterData()
    {
        $this->admin->saveRegisterData();
    }

    public function setting_pricerate_page()
    {
        $this->load->view("templates/admin/head");
        $this->load->view("pricerate_list");
        $this->load->view("templates/admin/footer");
    }

    public function addSettingPriceRate()
    {
        $this->load->view("templates/admin/head");
        $this->load->view("setting_pricerate");
        $this->load->view("templates/admin/footer");
    }

    public function saveSettingPrice()
    {
        $this->admin->saveSettingPrice();
    }

    public function loadPricerateList()
    {
        $this->admin->loadPricerateList();
    }

    public function saveEditPricerate()
    {
        $this->admin->saveEditPricerate();
    }


}

/* End of file Controllername.php */


?>