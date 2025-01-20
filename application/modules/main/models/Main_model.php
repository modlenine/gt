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

            // $message = "\n🚩 บริษัทได้รับรายการของท่านเรียบร้อยแล้ว เจ้าหน้าที่กำลังตรวจสอบสอบข้อมูล \n✅ รายการเลขที่ $formno \n🚗 ต้นทางจาก : $origin \n🚗 ปลายทาง : $destination \n💸 ค่าใช้จ่ายทั้งสิ้น : $totalprice";
            // $token = $this->session->accesstoken;
            // $response = sendLineNotify($message, $token);

            // $messageAdmin = "\n✅ มีรายการ เรียกรถเข้ามาใหม่ รอตรวจสอบข้อมูล\n✅ เอกสารเลขที่ : $formno \n🚗 ต้นทางจาก : $origin \n🚗 ปลายทาง : $destination";
            // $tokenAdmin = getAdmintoken()->t_token;
            // $responseAdmin = sendLineNotify($messageAdmin, $tokenAdmin);

            $output = array(
                "msg" => "บันทึกข้อมูลสำเร็จ",
                "status" => "Insert Data Success"
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
    

}

/* End of file ModelName.php */


?>