<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driverslogin_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }


    public function drivers_checklogin()
    {
        if(!empty($this->input->post("drivers-username")) && !empty($this->input->post("drivers-password"))){
            $username = $this->input->post("drivers-username");
            $password = $this->input->post("drivers-password");

            $sql = $this->db->query("SELECT * FROM member_drivers WHERE dv_username =? AND dv_password=? AND dv_status = 'active'" , array($username , $password));

            if($sql->num_rows() != 0){
                $_SESSION['dv_username'] = $sql->row()->dv_username;
                $_SESSION['dv_fnameth'] = $sql->row()->dv_fnameth;
                $_SESSION['dv_lnameth'] = $sql->row()->dv_lnameth;
                $_SESSION['dv_permission'] = $sql->row()->dv_permission;

                // insert login log
                session_write_close();
                header('location:' . base_url('backend/drivers'));
                exit();
            }else{
                echo $this->session->set_flashdata('msgdriver', '<div class="alert alert-danger" role="alert" style="font-size:15px;text-align: center;">ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง</div>');
                header('location:' . base_url('driverslogin'));
                exit();
            }
        }else{
            echo $this->session->set_flashdata('msgdriver', '<div class="alert alert-danger" role="alert" style="font-size:15px;text-align: center;">กรุณาระบุชื่อผู้ใช้และรหัสผ่าน</div>');
            header('location:' . base_url('driverslogin'));
            exit();
        }
    }

    public function drivers_logout()
    {
        $this->session->unset_userdata('dv_username');
        $this->session->unset_userdata('dv_fname');
        $this->session->unset_userdata('dv_lname');
        $this->session->unset_userdata('dv_permission');
        die();
    }

    public function uploadFile_mem_doc1()
    {
        uploadFile_register();
    }

    public function removeFile_mem_doc1()
    {
        removeFile_register();
    }

    public function uploadFile_mem_doc2()
    {
        uploadFile_register();
    }

    public function removeFile_mem_doc2()
    {
        removeFile_register();
    }

    public function uploadFile_mem_doc3()
    {
        uploadFile_register();
    }

    public function removeFile_mem_doc3()
    {
        removeFile_register();
    }

    public function uploadFile_mem_doc4()
    {
        uploadFile_register();
    }

    public function removeFile_mem_doc4()
    {
        removeFile_register();
    }

    public function saveRegisterAccept()
    {
        $this->db->trans_start();

        $fnameTH = $this->input->post("fnameTH");
        $lnameTH = $this->input->post("lnameTH");
        $fnameEN = $this->input->post("fnameEN");
        $lnameEN = $this->input->post("lnameEN");
        $tel = $this->input->post("tel");
        $lineid = $this->input->post("lineid");
        $numberplate = $this->input->post("numberplate");
        $username = $this->input->post("username");
        $registerNo = getRegisNo();
        $password = $this->input->post("password");

        $arInsert = array(
            "dv_username" => $username,
            "dv_fnameth" => $fnameTH,
            "dv_lnameth" => $lnameTH,
            "dv_fnameen" => $fnameEN,
            "dv_lnameen" => $lnameEN,
            "dv_tel" => $tel,
            "dv_lineid" => $lineid,
            "dv_number_plate" => $numberplate,
            "dv_registerno" => $registerNo,
            "dv_permission" => "Driver",
            "dv_privacy_status" => "yes",
            "dv_status" => "wait approve",
            "dv_register_datetime" => date("Y-m-d H:i:s"),
            "dv_password" => $password

        );
        $this->db->insert("member_drivers" , $arInsert);

        $arInsertRe = array(
            "regis_no" => $registerNo,
            "regis_datetime" => date("Y-m-d H:i:s")
        );
        $this->db->insert("register_no_autorun" , $arInsertRe);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $output = array(
                "msg" => "ทำรายการไม่สำเร็จ พบปัญหาการบันทึกข้อมูล",
                "status" => "System Failed"
            );
        }else{
            $output = array(
                "msg" => "อัพเดตข้อมูลการยืนยันการโอนเงินสำเร็จ",
                "status" => "Insert Data Success",
                "registerNo" => $registerNo
            );
            //ส่ง Emial หรือการแจ้งเตือนไปยัง Admin เพื่อให้ตรวจสอบข้อมูล
        }

        echo json_encode($output);
    }
    
    

}

/* End of file ModelName.php */
?>
