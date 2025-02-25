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
                    $thText = "";
                    if($row[8] == "Driver Get Job"){
                        $thText = "รับงานแล้ว";
                    }else if($row[8] == "Driver Check In"){
                        $thText = "ถึงต้นทางแล้ว";
                    }else if($row[8] == "Driver Start Job"){
                        $thText = "กำลังเดินทาง";
                    }else if($row[8] == "Driver Check In Destination"){
                        $thText = "ถึงปลายทางแล้ว";
                    }
                    $output ='
                    <a href="'.base_url('backend/drivers/request_viewfull_page/').$d.'" class="select_formno">
                    <b>'.$d.'</b>
                    <p style="color:#009900;"><b>[ '.$thText.' ]</b></p>
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

        $username = $this->session->dv_username;
        $queryByUser = "m_dv_user_getjob = '$username'";

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, "$queryByUser", null)
        );
    }

    public function request_job_list_close()
    {
        // DB table to use
        $table = 'request_job_list_close';

        // Table's primary key
        $primaryKey = 'm_autoid';

        $columns = array(
            array('db' => 'm_formno', 'dt' => 0,
                'formatter' => function($d , $row){
                    $thText = "";
                    if($row[8] == "Driver Get Job"){
                        $thText = "รับงานแล้ว";
                    }else if($row[8] == "Driver Check In"){
                        $thText = "ถึงต้นทางแล้ว";
                    }else if($row[8] == "Driver Start Job"){
                        $thText = "กำลังเดินทาง";
                    }else if($row[8] == "Driver Check In Destination"){
                        $thText = "ถึงปลายทางแล้ว";
                    }else if($row[8] == "Driver Close Job"){
                        $thText = "ปิดงานแล้ว";
                    }
                    $output ='
                    <a href="'.base_url('backend/drivers/request_viewfull_page/').$d.'" class="select_formno">
                    <b>'.$d.'</b>
                    <p style="color:#009900;"><b>[ '.$thText.' ]</b></p>
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

        $username = $this->session->dv_username;
        $queryByUser = "m_dv_user_getjob = '$username'";

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, "$queryByUser", null)
        );
    }

    public function checkJobProgress($formno)
    {
        $driverusername = $this->session->dv_username;
        $sql = $this->db->query("SELECT
        m_formno
        FROM main WHERE m_dv_user_getjob = ? AND m_status IN ('Driver Get Job' , 'Driver Check In' , 'Driver Start Job' , 'Driver Check In Destination')
        " , array($driverusername));

        if($sql->num_rows() > 0){
            return $sql->row()->m_formno == $formno ? true : false;
        }else{
            return true;
        }
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
            member.mem_line_pictureUrl,
            main.m_dv_user_checkin
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

    public function clearDataTempByUser()
    {
        if(!empty($this->input->post("driverusername"))){
            $this->db->trans_start();
            $driverusername = $this->input->post("driverusername");
            $sql = $this->db->query("SELECT
            f_path,
            f_name
            FROM files_dv_temp WHERE f_driverusername = ?
            " , array($driverusername));

            if($sql->num_rows() > 0){
                foreach($sql->result() as $rs){
                    $filePath = $rs->f_path . $rs->f_name;
                    if (file_exists($filePath)){
                        unlink($filePath);
                    }
                }
                $this->db->where("f_driverusername" , $driverusername);
                $this->db->delete("files_dv_temp");

                $this->db->trans_complete();

                $output = array(
                    "msg" => "ลบไฟล์ Temp สำเร็จ",
                    "status" => "Delete Data Success"
                );
            }else{
                $output = array(
                    "msg" => "ไม่พบข้อมูล Temp ที่ต้องลบ",
                    "status" => "Not Found Temp Data"
                );
            }
        }else{
            $output = array(
                "msg" => "ไม่พบข้อมูล Temp ที่ต้องลบ",
                "status" => "Not Found Temp Data"
            );
        }
        echo json_encode($output);
    }

    public function getJob()
    {
        if(!empty($this->input->post("formno"))){
            $formno = $this->input->post("formno");
            $getJobLat = $this->input->post("lat");
            $getJobLng = $this->input->post("lng");
            $this->db->trans_start();
            // บันทึกเวลาปัจจุบัน + 40 นาที
            $checkin_time = time(); // เวลาปัจจุบัน (timestamp)
            $expiry_time = $checkin_time + (5 * 60); // บวกเพิ่ม 40 นาที

            $arUpdateData = array(
                "m_status" => "Driver Get Job",
                "m_dv_user_getjob" => $this->session->dv_username,
                "m_dv_timeexpire_getjob" => $expiry_time,
                "m_dv_datetime_getjob" => date("Y-m-d H:i:s"),
                "m_dv_getjob_lat" => $getJobLat,
                "m_dv_getjob_lng" => $getJobLng
            );

            $this->db->where("m_formno" , $formno);
            $this->db->update("main" , $arUpdateData);

            $this->db->trans_complete();

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
            m_status,
            m_dv_getjob_lat,
            m_dv_getjob_lng
            FROM main WHERE m_formno = ?
            " , array($formno));

            $drivername = getDriverData($sql->row()->m_dv_user_getjob)->dv_fname." ".getDriverData($sql->row()->m_dv_user_getjob)->dv_lname;

            $output = array(
                "msg" => "ดึงข้อมูล Time Expire สำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->row(),
                "drivername" => $drivername
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
            $this->db->trans_start();
            $arupdate = array(
                "m_dv_timeexpire_getjob" => null,
                "m_status" => "Payment Checked",
                "m_dv_user_getjob" => null,
                "m_dv_getjob_lat" => null,
                "m_dv_getjob_lng" => null
            );

            $this->db->where("m_formno" , $formno);
            $this->db->update("main" , $arupdate);
            $this->db->trans_complete();
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
            $this->db->trans_start();
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

            $this->db->trans_complete();

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

    public function checkin()
    {
        if(!empty($this->input->post("formno")) && !empty($this->input->post("driverUsername"))){
            $this->db->trans_start();
            $formno = $this->input->post('formno');
            $driverUsername = $this->input->post("driverUsername");
            $checkinLat = $this->input->post("lat");
            $checkinLng = $this->input->post("lng");

            $arupdate = array(
                "m_status" => "Driver Check In",
                "m_dv_user_checkin" => $driverUsername,
                "m_dv_datetime_checkin" => date("Y-m-d H:i:s"),
                "m_dv_checkin_lat" => $checkinLat,
                "m_dv_checkin_lng" => $checkinLng,
                "m_dv_timeexpire_getjob" => null
            );

            $this->db->where("m_formno" , $formno);
            $this->db->update("main" , $arupdate);

            $this->db->trans_complete();

            $output = array(
                "msg" => "เช็กอินสำเร็จ",
                "status" => "Update Data Success",
                "lat" => $checkinLat,
                "lng" => $checkinLng
            );
        }else{
            $output = array(
                "msg" => "เช็กอินไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function checkinDes()
    {
        if(!empty($this->input->post("formno")) && !empty($this->input->post("driverUsername"))){
            $this->db->trans_start();
            $formno = $this->input->post('formno');
            $driverUsername = $this->input->post("driverUsername");
            $checkinLat = $this->input->post("lat");
            $checkinLng = $this->input->post("lng");

            $arupdate = array(
                "m_status" => "Driver Check In Destination",
                "m_dv_user_checkindes" => $driverUsername,
                "m_dv_datetime_checkindes" => date("Y-m-d H:i:s"),
                "m_dv_checkindes_lat" => $checkinLat,
                "m_dv_checkindes_lng" => $checkinLng,
            );

            $this->db->where("m_formno" , $formno);
            $this->db->update("main" , $arupdate);

            $this->db->trans_complete();

            $output = array(
                "msg" => "เช็กอินปลายทางสำเร็จ",
                "status" => "Update Data Success",
                "lat" => $checkinLat,
                "lng" => $checkinLng
            );
        }else{
            $output = array(
                "msg" => "เช็กอินปลายทางไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function getCheckInData()
    {
        if(!empty($this->input->post("formno")) && !empty($this->input->post("driverUsername"))){
            $formno = $this->input->post("formno");
            $driverUsername = $this->input->post("driverUsername");

            $sql = $this->db->query("SELECT
            m_dv_user_checkin,
            DATE_FORMAT(m_dv_datetime_checkin , '%d-%m-%Y %H:%i:%s')AS m_dv_datetime_checkin,
            m_dv_checkin_lat,
            m_dv_checkin_lng
            FROM main WHERE m_formno = ? AND m_dv_user_checkin = ?
            ",array($formno , $driverUsername));

            $drivername = getDriverData($driverUsername)->dv_fname." ".getDriverData($driverUsername)->dv_lname;

            $output = array(
                "msg" => "ดึงข้อมูล CheckIn สำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->row(),
                "drivername" => $drivername
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล CheckIn ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
        }

        echo json_encode($output);
    }

    public function getCheckInDataDes()
    {
        if(!empty($this->input->post("formno")) && !empty($this->input->post("driverUsername"))){
            $formno = $this->input->post("formno");
            $driverUsername = $this->input->post("driverUsername");

            $sql = $this->db->query("SELECT
            m_dv_user_checkindes,
            DATE_FORMAT(m_dv_datetime_checkindes , '%d-%m-%Y %H:%i:%s')AS m_dv_datetime_checkindes,
            m_dv_checkindes_lat,
            m_dv_checkindes_lng
            FROM main WHERE m_formno = ? AND m_dv_user_checkindes = ?
            ",array($formno , $driverUsername));

            $drivername = getDriverData($driverUsername)->dv_fname." ".getDriverData($driverUsername)->dv_lname;

            $output = array(
                "msg" => "ดึงข้อมูล CheckIn Destination สำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->row(),
                "drivername" => $drivername
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล CheckIn Destination ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
        }

        echo json_encode($output);
    }

    public function uploadFile_start()
    {
        uploadFile_start();
    }

    public function removeFile_start()
    {
        removeFile_start();
    }

    public function saveStart()
    {
        if(!empty($this->input->post("formno")) && !empty($this->input->post("driverusername")) && !empty($this->input->post("type"))){
            $this->db->trans_start();
            $formno = $this->input->post("formno");
            $driverusername = $this->input->post("driverusername");
            $type = $this->input->post("type");
            $memo = $this->input->post("memo");
            $lat = $this->input->post("lat");
            $lng = $this->input->post("lng");

            $sqlTemp = $this->db->query("SELECT
            f_formno,
            f_driverusername,
            f_path,
            f_type,
            f_name,
            f_datetime
            FROM files_dv_temp WHERE f_formno = ? AND f_driverusername = ? AND f_type = ?
            " , array($formno , $driverusername , $type));

            $sourcePathFile = "uploads/fileuploads_dv_temp/";
            $destinationPathFile = "uploads/fileuploads_dv/";
            foreach($sqlTemp->result() as $rs){
                $arInsert = array(
                    "f_formno" => $rs->f_formno,
                    "f_driverusername" => $rs->f_driverusername,
                    "f_path" => $destinationPathFile,
                    "f_type" => $rs->f_type,
                    "f_name" => $rs->f_name,
                    "f_datetime" => $rs->f_datetime
                );

                $this->db->insert("files_dv" , $arInsert);

                $sourceFile = $sourcePathFile . $rs->f_name;
                $destinationFile = $destinationPathFile . $rs->f_name;

                if (file_exists($sourceFile)) {
                    rename($sourceFile, $destinationFile);
                }
            }

            //Delete Data From temp
            $this->db->where("f_formno" , $formno);
            $this->db->where("f_driverusername" , $driverusername);
            $this->db->where("f_type" , $type);
            $this->db->delete("files_dv_temp");

            //Update Status
            $arupdate_main = array(
                "m_dv_user_start" => $driverusername,
                "m_dv_datetime_start" => date("Y-m-d H:i:s"),
                "m_dv_memo_start" => $memo,
                "m_status" => "Driver Start Job",
                "m_dv_start_lat" => $lat,
                "m_dv_start_lng" => $lng
            );
            $this->db->where("m_formno" , $formno);
            $this->db->where("m_dv_user_checkin" , $driverusername);
            $this->db->update("main" , $arupdate_main);
            $this->db->trans_complete();

            $output = array(
                "msg" => "บันทึกข้อมูล พร้อมย้ายไฟล์อกจาก Temp เรียบร้อยแล้ว",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "บันทึกข้อมูล พร้อมย้ายไฟล์อกจาก Temp ไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function getStartJobData()
    {
        if(!empty($this->input->post("formno")) && !empty($this->input->post("driverusername"))){
            $formno = $this->input->post("formno");
            $driverusername = $this->input->post("driverusername");
            $type = $this->input->post("type");

            $sqlMain = $this->db->query("SELECT
            m_dv_user_start,
            -- m_dv_datetime_start,
            DATE_FORMAT(m_dv_datetime_start , '%d-%m-%Y %H:%i:%s')AS m_dv_datetime_start,
            m_dv_memo_start,
            m_dv_start_lat,
            m_dv_start_lng
            FROM main WHERE m_formno = ? AND m_dv_user_start = ?
            " , array($formno , $driverusername));

            $sqlFile = $this->db->query("SELECT
            f_path,
            f_name
            FROM files_dv WHERE f_formno = ? AND f_driverusername = ? AND f_type = ?
            " , array($formno , $driverusername , $type));

            $drivername = getDriverData($driverusername)->dv_fname." ".getDriverData($driverusername)->dv_lname;

            $output = array(
                "msg" => "ดึงข้อมูล Start Job สำเร็จ",
                "status" => "Select Data Success",
                "result_main" => $sqlMain->row(),
                "result_files" => $sqlFile->result(),
                "drivername" => $drivername
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล Start Job ไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function uploadFile_stop()
    {
        uploadFile_stop();
    }

    public function removeFile_stop()
    {
        removeFile_stop();
    }

    public function saveStop()
    {
        if(!empty($this->input->post("formno")) && !empty($this->input->post("driverusername")) && !empty($this->input->post("type"))){
            $this->db->trans_start();
            $formno = $this->input->post("formno");
            $driverusername = $this->input->post("driverusername");
            $type = $this->input->post("type");
            $memo = $this->input->post("memo");
            $lat = $this->input->post("lat");
            $lng = $this->input->post("lng");

            $sqlTemp = $this->db->query("SELECT
            f_formno,
            f_driverusername,
            f_path,
            f_type,
            f_name,
            f_datetime
            FROM files_dv_temp WHERE f_formno = ? AND f_driverusername = ? AND f_type = ?
            " , array($formno , $driverusername , $type));

            $sourcePathFile = "uploads/fileuploads_dv_temp/";
            $destinationPathFile = "uploads/fileuploads_dv/";
            foreach($sqlTemp->result() as $rs){
                $arInsert = array(
                    "f_formno" => $rs->f_formno,
                    "f_driverusername" => $rs->f_driverusername,
                    "f_path" => $destinationPathFile,
                    "f_type" => $rs->f_type,
                    "f_name" => $rs->f_name,
                    "f_datetime" => $rs->f_datetime
                );

                $this->db->insert("files_dv" , $arInsert);

                $sourceFile = $sourcePathFile . $rs->f_name;
                $destinationFile = $destinationPathFile . $rs->f_name;

                if (file_exists($sourceFile)) {
                    rename($sourceFile, $destinationFile);
                }
            }

            //Delete Data From temp
            $this->db->where("f_formno" , $formno);
            $this->db->where("f_driverusername" , $driverusername);
            $this->db->where("f_type" , $type);
            $this->db->delete("files_dv_temp");

            //Update Status
            $arupdate_main = array(
                "m_dv_user_stop" => $driverusername,
                "m_dv_datetime_stop" => date("Y-m-d H:i:s"),
                "m_dv_memo_stop" => $memo,
                "m_status" => "Driver Close Job",
                "m_dv_stop_lat" => $lat,
                "m_dv_stop_lng" => $lng
            );
            $this->db->where("m_formno" , $formno);
            $this->db->where("m_dv_user_checkindes" , $driverusername);
            $this->db->update("main" , $arupdate_main);
            $this->db->trans_complete();

            $output = array(
                "msg" => "บันทึกข้อมูล พร้อมย้ายไฟล์อกจาก Temp เรียบร้อยแล้ว",
                "status" => "Update Data Success"
            );
        }else{
            $output = array(
                "msg" => "บันทึกข้อมูล พร้อมย้ายไฟล์อกจาก Temp ไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function getStopJobData()
    {
        if(!empty($this->input->post("formno")) && !empty($this->input->post("driverusername"))){
            $formno = $this->input->post("formno");
            $driverusername = $this->input->post("driverusername");
            $type = $this->input->post("type");

            $sqlMain = $this->db->query("SELECT
            m_dv_user_stop,
            -- m_dv_datetime_stop,
            DATE_FORMAT(m_dv_datetime_stop , '%d-%m-%Y %H:%i:%s')AS m_dv_datetime_stop,
            m_dv_memo_stop,
            m_dv_stop_lat,
            m_dv_stop_lng
            FROM main WHERE m_formno = ? AND m_dv_user_stop = ?
            " , array($formno , $driverusername));

            $sqlFile = $this->db->query("SELECT
            f_path,
            f_name
            FROM files_dv WHERE f_formno = ? AND f_driverusername = ? AND f_type = ?
            " , array($formno , $driverusername , $type));

            $drivername = getDriverData($driverusername)->dv_fname." ".getDriverData($driverusername)->dv_lname;

            $output = array(
                "msg" => "ดึงข้อมูล Start Job สำเร็จ",
                "status" => "Select Data Success",
                "result_main" => $sqlMain->row(),
                "result_files" => $sqlFile->result(),
                "drivername" => $drivername
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล Start Job ไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }
        echo json_encode($output);
    }
    
    

}

/* End of file ModelName.php */



?>