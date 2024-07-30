<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }


    public function backend_checklogin()
    {
        if(!empty($this->input->post("admin-username")) && !empty($this->input->post("admin-password"))){
            $username = $this->input->post("admin-username");
            $password = $this->input->post("admin-password");

            $sql = $this->db->query("SELECT * FROM member_admin WHERE am_username =? AND am_password=? " , array($username , $password));

            if($sql->num_rows() != 0){
                $_SESSION['am_username'] = $sql->row()->am_username;
                $_SESSION['am_fname'] = $sql->row()->am_fname;
                $_SESSION['am_lname'] = $sql->row()->am_lname;
                $_SESSION['am_permission'] = $sql->row()->am_permission;

                // insert login log
                session_write_close();
                header('location:' . base_url('backend/admin'));
                exit();
            }else{
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert" style="font-size:15px;text-align: center;">ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง</div>');
                header('location:' . base_url('backend/admin'));
                exit();
            }
        }else{
            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert" style="font-size:15px;text-align: center;">กรุณาระบุชื่อผู้ใช้และรหัสผ่าน</div>');
            header('location:' . base_url('adminlogin'));
            exit();
        }
    }
    
    

}

/* End of file ModelName.php */
?>
