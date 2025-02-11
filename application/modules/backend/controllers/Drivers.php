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
        $data = array(
            "title" => "",
            "param" => $param
        );
        $this->load->view("templates/drivers/head");
        $this->load->view("drivers_page/jobs_list" , $data);
        $this->load->view("templates/drivers/footer");
    }

}

/* End of file Controllername.php */
?>