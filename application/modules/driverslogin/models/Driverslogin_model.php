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

            $sql = $this->db->query("SELECT * FROM member_drivers WHERE dv_username =? AND dv_password=? " , array($username , $password));

            if($sql->num_rows() != 0){
                $_SESSION['dv_username'] = $sql->row()->dv_username;
                $_SESSION['dv_fname'] = $sql->row()->dv_fname;
                $_SESSION['dv_lname'] = $sql->row()->dv_lname;
                $_SESSION['dv_permission'] = $sql->row()->dv_permission;

                // insert login log
                session_write_close();
                header('location:' . base_url('backend/drivers'));
                exit();
            }else{
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert" style="font-size:15px;text-align: center;">ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง</div>');
                header('location:' . base_url('backend/drivers'));
                exit();
            }
        }else{
            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert" style="font-size:15px;text-align: center;">กรุณาระบุชื่อผู้ใช้และรหัสผ่าน</div>');
            header('location:' . base_url('driverlogin'));
            exit();
        }
    }
    
    

}

/* End of file ModelName.php */
?>
