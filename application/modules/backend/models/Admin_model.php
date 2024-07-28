<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function loadlist()
    {
        //code
    }
    
    

}

/* End of file Admin_model.php */



?>