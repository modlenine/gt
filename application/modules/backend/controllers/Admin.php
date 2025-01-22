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
            }else if($status == "publish_to_driver"){
                $this->admin->request_list_publishtodriver();
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

}

/* End of file Controllername.php */


?>