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
            $arSaveData = array(
                "m_formno" => $formno,
                "m_cusid" => $this->session->cusid,
                "m_origininput" => $this->input->post("origininput"),
                "m_destinationinput" => $this->input->post("destinationinput"),
                "m_cartype" => $this->input->post("cartype"),
                "m_distance" => $this->input->post("distance"),
                "m_sumpricecardistance" => $this->input->post("sumpricecardistance"),
                ""


            );
        }
        $output = array(
            "test" => $this->input->post('action'),
            "cusid" => $this->session->cusid
        );
        echo json_encode($output);
    }
    

}

/* End of file ModelName.php */


?>