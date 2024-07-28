<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }
    

    public function index()
    {
        $this->load->view("templates/admin/head");
        $this->load->view("index");
        $this->load->view("templates/admin/footer");
    }

}

/* End of file Controllername.php */


?>