<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    

    public function index()
    {
        $this->load->view("templates/drivers/head");
        $this->load->view("index");
        $this->load->view("templates/drivers/footer");
    }

}

/* End of file Controllername.php */
?>