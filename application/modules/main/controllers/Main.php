<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model("main_model" , "main");
        
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


}/* End of file Main.php */
?>