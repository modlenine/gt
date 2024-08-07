<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function request_list_checkdata()
    {
        // DB table to use
        $table = 'request_list_open';

        // Table's primary key
        $primaryKey = 'm_autoid';

        $columns = array(
            array('db' => 'm_formno', 'dt' => 0,
                'formatter' => function($d , $row){
                    $output ='
                    <a href="'.base_url('backend/admin/request_viewfull_page/').$d.'" class="select_formno"
                    ><b>'.$d.'</b></a>
                    ';
                    return $output;
                }
            ),
            array('db' => 'm_datetimecreate', 'dt' => 1 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'mem_fullname', 'dt' => 2 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'mem_tel', 'dt' => 3 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'm_origininput', 'dt' => 4 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'm_destinationinput', 'dt' => 5 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'm_cartype', 'dt' => 6 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'm_status', 'dt' => 7 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
        );

        // SQL server connection information
        $sql_details = array(
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_name,
            'host' => getDb()->db_host
        );

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require('server-side/scripts/ssp.class.php');

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, null)
        );
    }

    public function request_list_checkpayment()
    {
        // DB table to use
        $table = 'request_list_waitcheckpayment';

        // Table's primary key
        $primaryKey = 'm_autoid';

        $columns = array(
            array('db' => 'm_formno', 'dt' => 0,
                'formatter' => function($d , $row){
                    $output ='
                    <a href="#" class="select_formno"
                        data_formno="'.$d.'"
                    ><b>'.$d.'</b></a>
                    ';
                    return $output;
                }
            ),
            array('db' => 'm_datetimecreate', 'dt' => 1 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'mem_fullname', 'dt' => 2 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'mem_tel', 'dt' => 3 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'm_origininput', 'dt' => 4 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'm_destinationinput', 'dt' => 5 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'm_cartype', 'dt' => 6 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
            array('db' => 'm_status', 'dt' => 7 ,
                'formatter' => function($d , $row){
                    return $d;
                }
            ),
        );

        // SQL server connection information
        $sql_details = array(
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_name,
            'host' => getDb()->db_host
        );

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require('server-side/scripts/ssp.class.php');

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, null)
        );
    }

    public function request_list_checkpaymented()
    {

    }

    public function request_list_publishtodriver()
    {

    }
    
    

}

/* End of file Admin_model.php */



?>