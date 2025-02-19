<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function request_job_list_avaliable()
    {
        // DB table to use
        $table = 'request_job_list_avaliable';

        // Table's primary key
        $primaryKey = 'm_autoid';

        $columns = array(
            array('db' => 'm_formno', 'dt' => 0,
                'formatter' => function($d , $row){
                    $output ='
                    <a href="'.base_url('backend/drivers/request_viewfull_page/').$d.'" class="select_formno">
                    <b>'.$d.'</b>
                    <p style="color:#009900;"><b>[ ว่าง ]</b></p>
                    </a>
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
            array('db' => 'm_totalprice', 'dt' => 7 ,
                'formatter' => function($d , $row){
                    return number_format($d , 2);
                }
            ),
            array('db' => 'm_status', 'dt' => 8 ,
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

    public function request_job_list_pending()
    {
        // DB table to use
        $table = 'request_job_list_pending';

        // Table's primary key
        $primaryKey = 'm_autoid';

        $columns = array(
            array('db' => 'm_formno', 'dt' => 0,
                'formatter' => function($d , $row){
                    $output ='
                    <a href="'.base_url('backend/drivers/request_viewfull_page/').$d.'" class="select_formno">
                    <b>'.$d.'</b>
                    <p style="color:#009900;"><b>[ รับงาน ]</b></p>
                    </a>
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
            array('db' => 'm_totalprice', 'dt' => 7 ,
                'formatter' => function($d , $row){
                    return number_format($d , 2);
                }
            ),
            array('db' => 'm_status', 'dt' => 8 ,
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


    public function get_viewfulldata_topage($formno)
    {
        if(!empty($formno)){
            $sql = $this->db->query("SELECT
            main.m_autoid,
            main.m_formno,
            main.m_cusid,
            main.m_origininput,
            main.m_destinationinput,
            main.m_cartype,
            main.m_distance,
            main.m_sumpricecardistance,
            main.m_personsumprice,
            main.m_totalprice,
            main.m_persontyped1,
            main.m_persontyped2,
            main.m_persontypee1,
            main.m_persontypee2,
            main.m_datetimecreate,
            main.m_status,
            main.m_deposit_percen,
            main.m_deposit,
            main.m_userconfirm_money,
            main.m_am2_memo,
            main.m_am1_memo,
            member.mem_fname,
            member.mem_lname,
            member.mem_email,
            member.mem_tel,
            member.mem_line_pictureUrl
            FROM
            main
            INNER JOIN member ON member.mem_line_userId = main.m_cusid
            WHERE main.m_formno = ?
            " , array($formno));

            if($sql->num_rows() > 0){
                return $sql;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function getJob()
    {
        if(!empty($this->input->post("formno"))){
            $formno = $this->input->post("formno");

            // บันทึกเวลาปัจจุบัน + 40 นาที
            $checkin_time = time(); // เวลาปัจจุบัน (timestamp)
            $expiry_time = $checkin_time + (2 * 60); // บวกเพิ่ม 40 นาที

            $arUpdateData = array(
                "m_status" => "Driver Get Job",
                "m_dv_user_getjob" => $this->session->dv_username,
                "m_dv_timeexpire_getjob" => $expiry_time
            );

            $this->db->where("m_formno" , $formno);
            $this->db->update("main" , $arUpdateData);

            $output = array(
                "msg" => "บันทึกการรับงานสำเร็จ",
                "status" => "Update Data Success",
            );
        }else{
            $output = array(
                "msg" => "บันทึกการรับงานไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function getExpireTime()
    {
        if(!empty($this->input->post("formno"))){
            $formno = $this->input->post("formno");

            $sql = $this->db->query("SELECT
            m_dv_timeexpire_getjob,
            m_dv_user_getjob,
            m_status
            FROM main WHERE m_formno = ?
            " , array($formno));

            $output = array(
                "msg" => "ดึงข้อมูล Time Expire สำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->row()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล Time Expire ไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function getJobTimeout()
    {
        if(!empty($this->input->post("formno"))){
            $formno = $this->input->post("formno");

            $arupdate = array(
                "m_dv_timeexpire_getjob" => null,
                "m_status" => "Payment Checked",
                "m_dv_user_getjob" => null
            );

            $this->db->where("m_formno" , $formno);
            $this->db->update("main" , $arupdate);

            $output = array(
                "msg" => "ล้างค่าการจองงานสำเร็จ สามารถรับงานได้",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "ดำเนินการไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }

        echo json_encode($output);
    }

    public function jl_checkExpireTime()
    {
        $sql = $this->db->query("SELECT
        m_dv_user_getjob,
        m_dv_timeexpire_getjob,
        m_autoid
        FROM main WHERE m_status = 'Driver Get Job' AND m_dv_user_getjob IS NOT NULL AND m_dv_user_getjob IS NOT NULL
        ");

        if($sql->num_rows() > 0){
            $count = 0;
            foreach($sql->result() as $rs){
                $expireTime = $rs->m_dv_timeexpire_getjob;
                $rowid = $rs->m_autoid;
                $timeNow = time(); // เวลาปัจจุบัน (timestamp)
                if($expireTime < $timeNow){
                    $arUpdateExtime = array(
                        "m_status" => "Payment Checked",
                        "m_dv_user_getjob" => null,
                        "m_dv_timeexpire_getjob" => null
                    );

                    $this->db->where("m_autoid" , $rowid);
                    $this->db->update("main" , $arUpdateExtime);
                    $count++;
                }
            }

            $output = array(
                "msg" => "ปรับปรุงรายการสำเร็จทั้งสิ้น $count รายการ",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "ไม่พบรายการที่ต้องปรับปรุง",
                "status" => "Checked Data Success"
            );
        }

        echo json_encode($output);
    }
    
    

}

/* End of file ModelName.php */



?>