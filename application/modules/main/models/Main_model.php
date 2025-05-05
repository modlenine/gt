<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        date_default_timezone_set("Asia/Bangkok");
    }
    
    public function getDistanceRate()
    {
        $received_data = json_decode(file_get_contents("php://input"));
        if($received_data->action == "getDistanceRate"){
            $distance = floatval($received_data->distance);

            $sql = $this->db->query("SELECT
            d_calrate
            FROM distance_master 
            WHERE ? BETWEEN d_kmstart AND d_kmend", array($distance));

            $output = array(
                "msg" => "ดึงข้อมูล Distance Range สำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->row()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล Distance Range ไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function saveSendtoApprove()
    {
        if($this->input->post("action") == "sendtoapprove"){
            $formno = getFormNo();
            $userId = $this->session->userId;
            $origin = $this->input->post("origininput");
            $destination = $this->input->post("destinationinput");
            $totalprice = $this->input->post("totalprice");
            $arSaveData = array(
                "m_formno" => $formno,
                "m_cusid" => $userId,
                "m_origininput" => $origin,
                "m_destinationinput" => $destination,
                "m_cartype" => $this->input->post("cartype"),
                "m_distance" => $this->input->post("distance"),
                "m_sumpricecardistance" => $this->input->post("sumpricecardistance"),
                "m_personsumprice" => $this->input->post("personsumprice"),
                "m_totalprice" => $totalprice,
                "m_persontyped1" => $this->input->post("persontyped1"),
                "m_persontyped2" => $this->input->post("persontyped2"),
                "m_persontypee1" => $this->input->post("persontypee1"),
                "m_persontypee2" => $this->input->post("persontypee2"),
                "m_datetimecreate" => date("Y-m-d H:i:s"),
                "m_status" => "Open"
            );

            $this->db->insert("main" , $arSaveData);

            $message = "\n🚩 บริษัทได้รับรายการของท่านเรียบร้อยแล้ว เจ้าหน้าที่กำลังตรวจสอบสอบข้อมูล \n✅ รายการเลขที่ $formno \n🚗 ต้นทางจาก : $origin \n🚗 ปลายทาง : $destination \n💸 ค่าใช้จ่ายทั้งสิ้น : $totalprice";
            $token = $this->session->accesstoken;
            $response = sendLineNotify($message, $token);

            // $messageAdmin = "\n✅ มีรายการ เรียกรถเข้ามาใหม่ รอตรวจสอบข้อมูล\n✅ เอกสารเลขที่ : $formno \n🚗 ต้นทางจาก : $origin \n🚗 ปลายทาง : $destination";
            // $tokenAdmin = getAdmintoken()->t_token;
            // $responseAdmin = sendLineNotify($messageAdmin, $tokenAdmin);


            $url = "https://gttransport.co.th/gt/backend/admin/request_list_page/data/".$formno;

            $token = "7761809698:AAHDQFnXNSoh6lSDlusDLOYVBpTneeA_s5M";
            $chat_id = "-4656603888"; //GT Admin Grokup
            $message = "<b>✅ มีรายการ เรียกรถเข้ามาใหม่ รอตรวจสอบข้อมูล</b>\n"
            ."<b>เอกสารเลขที่ : </b><a href='$url'>$formno </a>\n"
            ."<b>ต้นทางจาก : </b> $origin \n"
            ."<b>ปลายทาง : </b> $destination";
            $response = send_notify($token , $chat_id , $message);

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Insert Data Success",
                "notify_response" => $response
            );
        }else{
            $output = array(
                "msg" => "บันทึกข้อมูลไม่สำเร็จ",
                "status" => "Insert Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function get_requestList()
    {
        if($this->input->post("action") == "get_requestList"){
            $userId = $this->input->post("userId");
            $sql = $this->db->query("SELECT
            main.m_autoid AS m_autoid,
            main.m_formno AS m_formno,
            main.m_cusid AS m_cusid,
            main.m_origininput AS m_origininput,
            main.m_destinationinput AS m_destinationinput,
            main.m_cartype AS m_cartype,
            main.m_distance AS m_distance,
            main.m_sumpricecardistance AS m_sumpricecardistance,
            main.m_personsumprice AS m_personsumprice,
            main.m_totalprice AS m_totalprice,
            main.m_status AS m_status,
            member.mem_line_pictureUrl AS mem_line_pictureUrl,
            member.mem_line_accesstoken AS mem_line_accesstoken,
            member.mem_fname AS mem_fname,
            member.mem_lname AS mem_lname,
            member.mem_tel AS mem_tel,
            DATE_FORMAT(m_datetimecreate , '%d/%m/%Y %H:%i:%s') AS m_datetimecreate
            FROM
            member
            JOIN main
            ON member.mem_line_userId = main.m_cusid
            WHERE main.m_cusid = '$userId'
            ORDER BY m_autoid DESC
            ");

            $output = array(
                "msg" => "ดึงข้อมูลรายการเรียกรถสำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลรายการเรียกรถไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function get_viewfulldata_topage($formno , $userid)
    {
        if(!empty($formno) && !empty($userid)){
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
            main.m_deposit,
            main.m_am1_memo,
            main.m_persontyped1,
            main.m_persontyped2,
            main.m_persontypee1,
            main.m_persontypee2,
            main.m_datetimecreate,
            main.m_status,
            member.mem_fname,
            member.mem_lname,
            member.mem_email,
            member.mem_tel,
            member.mem_line_pictureUrl
            FROM
            main
            INNER JOIN member ON member.mem_line_userId = main.m_cusid
            WHERE main.m_formno = ? AND main.m_cusid = ?
            " , array($formno , $userid));

            if($sql->num_rows() > 0){
                return $sql;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function uploadFile_confirmPay()
    {
        //test
        uploadImage_new();
    }

    public function remove_confirmPay()
    {
        del_fileupload();
    }

    public function removeTempFile_byuser()
    {
        if(!empty($this->input->post("userid"))){
            $userid = $this->input->post("userid");

            $this->db->trans_start();
            //Get Data File name
            $sql = $this->db->query("SELECT
            f_path,
            f_name
            FROM files_temp
            WHERE f_cusid = ?
            ",array($userid));

            //unlink file
            foreach($sql->result() as $rs){
                $file_dir = $rs->f_path;
                $file_name = $rs->f_name;
                $filePath = $file_dir.$file_name;
                if(file_exists($filePath)){
                    unlink($filePath);
                }
            }

            //Delete file database
            $this->db->where('f_cusid' , $userid);
            $this->db->delete('files_temp');
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $output = array(
                    "msg" => "ลบ filetemp ไม่สำเร็จ",
                    "status" => "Found Status Change",
                );
            }else{
                $output = array(
                    "msg" => "ลบ filetemp สำเร็จ",
                    "status" => "Update Data Success",
                );
            }
        }else{
            $output = array(
                "msg" => "ลบ filetemp ไม่สำเร็จ",
                "status" => "Update Data Not Success",
            );
        }
        echo json_encode($output);
    }

    public function saveConfirmPay()
    {
        if(!empty($this->input->post("formno")) && !empty($this->input->post("userid")) && !empty($this->input->post("confirmNumPay"))){

            $this->db->trans_start();

            $formno = $this->input->post("formno");
            $userid = $this->input->post("userid");
            $confirmNumPay = $this->input->post("confirmNumPay");

            //copy file
            $sql_getdatafile = $this->db->query("SELECT
            f_formno,
            f_cusid,
            f_path,
            f_type,
            f_name,
            f_datetime
            FROM files_temp WHERE f_formno = ? AND f_cusid = ?
            " , array($formno , $userid));

            foreach($sql_getdatafile->result() as $rs){
                $arsaveFileData = array(
                    "f_formno" => $rs->f_formno,
                    "f_cusid" => $rs->f_cusid,
                    "f_path" => "uploads/fileuploads/",
                    "f_type" => $rs->f_type,
                    "f_name" => $rs->f_name,
                    "f_datetime" => $rs->f_datetime
                );
                $this->db->insert("files" , $arsaveFileData);

                $sourceFile = $rs->f_path . $rs->f_name;
                $destinationFile = "uploads/fileuploads/" . $rs->f_name;

                if (file_exists($sourceFile)) {
                    rename($sourceFile, $destinationFile);
                }
            }

            //Delete file_temp data 
            $this->db->where("f_formno" , $formno);
            $this->db->where("f_cusid" , $userid);
            $this->db->delete("files_temp");

            //update main data
            $arUpdateMainData = array(
                "m_userconfirm_money" => $confirmNumPay,
                "m_userconfirm_datetime" => date("Y-m-d H:i:s"),
                "m_status" => "Payment Confirmed"
            );

            $this->db->where("m_formno" , $formno);
            $this->db->update("main" , $arUpdateMainData);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $output = array(
                    "msg" => "ทำรายการไม่สำเร็จ พบปัญหาการบันทึกข้อมูล",
                    "status" => "System Failed"
                );
            }else{
                $output = array(
                    "msg" => "อัพเดตข้อมูลการยืนยันการโอนเงินสำเร็จ",
                    "status" => "Update Data Success"
                );
                //ส่ง Emial หรือการแจ้งเตือนไปยัง Admin เพื่อให้ตรวจสอบข้อมูล
            }
        }else{
            $output = array(
                "msg" => "อัพเดตข้อมูลการยืนยันการโอนเงินไม่สำเร็จ",
                "status" => "Update Data Not Success"
            );
        }
        echo json_encode($output);
    }


    public function getDataConfirmPay()
    {
        if(!empty($this->input->post("formno"))){
            $formno = $this->input->post("formno");

            $sql = $this->db->query("SELECT
            main.m_userconfirm_money
            FROM
            main
            WHERE main.m_formno = ?
            " , array($formno));

            $sqlFile = $this->db->query("SELECT
            f_path,
            f_name
            FROM files WHERE f_formno = ?
            " , array($formno));

            $output = array(
                "msg" => "ดึงข้อมูล User confirm pay สำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->row(),
                "resultFile" => $sqlFile->result()
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล User confirm pay ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
        }
        echo json_encode($output);
    }

    public function getDriverGetjobData()
    {
        if(!empty($this->input->post("formno"))){
            $formno = $this->input->post("formno");
            $sql = $this->db->query("SELECT
            m_dv_user_getjob,
            -- m_dv_datetime_getjob,
            DATE_FORMAT(m_dv_datetime_getjob , '%d-%m-%Y %H:%i:%s') AS m_dv_datetime_getjob,
            m_dv_getjob_lat,
            m_dv_getjob_lng
            FROM main WHERE m_formno = ?
            ",array($formno));

            if($sql->num_rows() > 0){
                $drivername = getDriverData($sql->row()->m_dv_user_getjob)->dv_fname." ".getDriverData($sql->row()->m_dv_user_getjob)->dv_lname;
                $drivertel = getDriverData($sql->row()->m_dv_user_getjob)->dv_tel;

                $output = array(
                    "msg" => "ดึงข้อมูลคนขับที่รับงานสำเร็จ",
                    "status" => "Select Data Success",
                    "drivername" => $drivername,
                    "drivertel" => $drivertel,
                    "result" => $sql->row()
                );
            }else{
                $output = array(
                    "msg" => "ไม่พบข้อมูลการรับงาน",
                    "status" => "Not Found Data",
                );
            }
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
        }
        echo json_encode($output);
    }

    public function getDriverCheckinData()
    {
        if(!empty($this->input->post("formno"))){
            $formno = $this->input->post("formno");
            $sql = $this->db->query("SELECT
            m_dv_user_checkin,
            DATE_FORMAT(m_dv_datetime_checkin , '%d-%m-%Y %H:%i:%s') AS m_dv_datetime_checkin,
            -- m_dv_datetime_checkin,
            m_dv_checkin_lat,
            m_dv_checkin_lng
            FROM main WHERE m_formno = ?
            ",array($formno));

            if($sql->num_rows() > 0){

                $output = array(
                    "msg" => "ดึงข้อมูลคนขับเช็กอินต้นทางสำเร็จ",
                    "status" => "Select Data Success",
                    "result" => $sql->row()
                );
            }else{
                $output = array(
                    "msg" => "ไม่พบข้อมูลการรับงาน",
                    "status" => "Not Found Data",
                );
            }
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
        }
        echo json_encode($output);
    }

    public function getDriverStartJobData()
    {
        if(!empty($this->input->post("formno"))){
            $formno = $this->input->post("formno");
            $type = $this->input->post("type");

            $sqlMain = $this->db->query("SELECT
            m_dv_user_start,
            -- m_dv_datetime_start,
            DATE_FORMAT(m_dv_datetime_start , '%d-%m-%Y %H:%i:%s')AS m_dv_datetime_start,
            m_dv_memo_start,
            m_dv_start_lat,
            m_dv_start_lng
            FROM main WHERE m_formno = ?
            " , array($formno));

            $sqlFile = $this->db->query("SELECT
            f_path,
            f_name
            FROM files_dv WHERE f_formno = ? AND f_type = ?
            " , array($formno , $type));

            $drivername = getDriverData($sqlMain->row()->m_dv_user_start)->dv_fname." ".getDriverData($sqlMain->row()->m_dv_user_start)->dv_lname;

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

    public function getDriverCheckinDesData()
    {
        if(!empty($this->input->post("formno"))){
            $formno = $this->input->post("formno");
            $sql = $this->db->query("SELECT
            m_dv_user_checkindes,
            DATE_FORMAT(m_dv_datetime_checkindes , '%d-%m-%Y %H:%i:%s') AS m_dv_datetime_checkindes,
            -- m_dv_datetime_checkin,
            m_dv_checkindes_lat,
            m_dv_checkindes_lng
            FROM main WHERE m_formno = ?
            ",array($formno));

            if($sql->num_rows() > 0){

                $output = array(
                    "msg" => "ดึงข้อมูลคนขับเช็กอินปลายทางสำเร็จ",
                    "status" => "Select Data Success",
                    "result" => $sql->row()
                );
            }else{
                $output = array(
                    "msg" => "ไม่พบข้อมูลการเช็กอินปลายทาง",
                    "status" => "Not Found Data",
                );
            }
        }else{
            $output = array(
                "msg" => "ดึงข้อมูลไม่สำเร็จ",
                "status" => "Select Data Not Success",
            );
        }
        echo json_encode($output);
    }

    public function getDriverStopJobData()
    {
        if(!empty($this->input->post("formno"))){
            $formno = $this->input->post("formno");
            $type = $this->input->post("type");

            $sqlMain = $this->db->query("SELECT
            m_dv_user_stop,
            -- m_dv_datetime_start,
            DATE_FORMAT(m_dv_datetime_stop , '%d-%m-%Y %H:%i:%s')AS m_dv_datetime_stop,
            m_dv_memo_stop,
            m_dv_stop_lat,
            m_dv_stop_lng
            FROM main WHERE m_formno = ?
            " , array($formno));

            $sqlFile = $this->db->query("SELECT
            f_path,
            f_name
            FROM files_dv WHERE f_formno = ? AND f_type = ?
            " , array($formno , $type));

            $drivername = getDriverData($sqlMain->row()->m_dv_user_stop)->dv_fname." ".getDriverData($sqlMain->row()->m_dv_user_stop)->dv_lname;

            $output = array(
                "msg" => "ดึงข้อมูล Stop Job สำเร็จ",
                "status" => "Select Data Success",
                "result_main" => $sqlMain->row(),
                "result_files" => $sqlFile->result(),
                "drivername" => $drivername
            );
        }else{
            $output = array(
                "msg" => "ดึงข้อมูล Stop Job ไม่สำเร็จ",
                "status" => "Select Data Not Success"
            );
        }
        echo json_encode($output);
    }

    public function getPricerate()
    {
        if($this->input->post("action") == "getPricerate"){
            $cartype = $this->input->post("cartype");
            $this->db->where("cartype" , $cartype);
            $query = $this->db->get("setting_pricerate");

            echo json_encode([
                "status" => "success",
                "msg" => "ดึงข้อมูล Price rate สำเร็จ",
                "result" => $query->row()
            ]);
        }else{
            echo json_encode([
                "status" => "error",
                "msg" => "ดึงข้อมูล Price rate ไม่สำเร็จ",
            ]);
        }
    }


    
}
/* End of file ModelName.php */


?>