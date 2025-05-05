<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

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

        $columns = [
            ['db'       => 'm_formno', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    $output = '
                    <a href="' . base_url('backend/admin/request_viewfull_page/') . $d . '" class="select_formno"
                    ><b>' . $d . '</b></a>
                    ';
                    return $output;
                },
            ],
            ['db'       => 'm_datetimecreate', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'mem_fullname', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'mem_tel', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_origininput', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_destinationinput', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_cartype', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_totalprice', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    return number_format($d, 2);
                },
            ],
            ['db'       => 'm_status', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    $class = "";
                    if ($d == "Open") {
                        $class = "class='cardstatus_Open'";
                    } else if ($d == "Approved" || $d == "Payment Confirmed" || $d == "Payment Checked" || $d == "Driver Get Job" ||
                        $d == "Driver Check In" || $d == "Driver Start Job" || $d == "Driver Check In Destination") {
                        $class = "class='cardstatus_Approve'";
                    } else if ($d == "Driver Close Job") {
                        $class = "class='cardstatus_Done'";
                    } else if ($d == "Not Approved" || $d == "User Cancel" || $d == "Driver Cancel") {
                        $class = "class='cardstatus_Done'";
                    }
                    $htlml = '<span ' . $class . '>' . $d . '</span>';
                    return $htlml;
                },
            ],
        ];

        // SQL server connection information
        $sql_details = [
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_name,
            'host' => getDb()->db_host,
        ];

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require 'server-side/scripts/ssp.class.php';

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, null)
        );
    }

    public function get_viewfulldata_topage($formno)
    {
        if (! empty($formno)) {
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
            member.mem_fname,
            member.mem_lname,
            member.mem_email,
            member.mem_tel,
            member.mem_line_pictureUrl
            FROM
            main
            INNER JOIN member ON member.mem_line_userId = main.m_cusid
            WHERE main.m_formno = ?
            ", [$formno]);

            if ($sql->num_rows() > 0) {
                return $sql;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function request_list_checkpayment()
    {
        // DB table to use
        $table = 'request_list_waitcheckpayment';

        // Table's primary key
        $primaryKey = 'm_autoid';

        $columns = [
            ['db'       => 'm_formno', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    $output = '
                    <a href="' . base_url('backend/admin/request_viewfull_page/') . $d . '" class="select_formno"
                    ><b>' . $d . '</b></a>
                    ';
                    return $output;
                },
            ],
            ['db'       => 'm_datetimecreate', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'mem_fullname', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'mem_tel', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_origininput', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_destinationinput', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_cartype', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_totalprice', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    return number_format($d, 2);
                },
            ],
            ['db'       => 'm_status', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    $class = "";
                    if ($d == "Open") {
                        $class = "class='cardstatus_Open'";
                    } else if ($d == "Approved" || $d == "Payment Confirmed" || $d == "Payment Checked" || $d == "Driver Get Job" ||
                        $d == "Driver Check In" || $d == "Driver Start Job" || $d == "Driver Check In Destination") {
                        $class = "class='cardstatus_Approve'";
                    } else if ($d == "Driver Close Job") {
                        $class = "class='cardstatus_Done'";
                    } else if ($d == "Not Approved" || $d == "User Cancel" || $d == "Driver Cancel") {
                        $class = "class='cardstatus_Done'";
                    }
                    $htlml = '<span ' . $class . '>' . $d . '</span>';
                    return $htlml;
                },
            ],
        ];

        // SQL server connection information
        $sql_details = [
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_name,
            'host' => getDb()->db_host,
        ];

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require 'server-side/scripts/ssp.class.php';

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, null)
        );
    }

    public function request_list_checkpaymented()
    {
        // DB table to use
        $table = 'request_list_waitDriverAccept';

        // Table's primary key
        $primaryKey = 'm_autoid';

        $columns = [
            ['db'       => 'm_formno', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    $output = '
                    <a href="' . base_url('backend/admin/request_viewfull_page/') . $d . '" class="select_formno"
                    ><b>' . $d . '</b></a>
                    ';
                    return $output;
                },
            ],
            ['db'       => 'm_datetimecreate', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'mem_fullname', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'mem_tel', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_origininput', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_destinationinput', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_cartype', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_totalprice', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    return number_format($d, 2);
                },
            ],
            ['db'       => 'm_status', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    $class = "";
                    if ($d == "Open") {
                        $class = "class='cardstatus_Open'";
                    } else if ($d == "Approved" || $d == "Payment Confirmed" || $d == "Payment Checked" || $d == "Driver Get Job" ||
                        $d == "Driver Check In" || $d == "Driver Start Job" || $d == "Driver Check In Destination") {
                        $class = "class='cardstatus_Approve'";
                    } else if ($d == "Driver Close Job") {
                        $class = "class='cardstatus_Done'";
                    } else if ($d == "Not Approved" || $d == "User Cancel" || $d == "Driver Cancel") {
                        $class = "class='cardstatus_Done'";
                    }
                    $htlml = '<span ' . $class . '>' . $d . '</span>';
                    return $htlml;
                },
            ],
        ];

        // SQL server connection information
        $sql_details = [
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_name,
            'host' => getDb()->db_host,
        ];

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require 'server-side/scripts/ssp.class.php';

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, null)
        );
    }

    public function request_list_drivergetjob()
    {
        // DB table to use
        $table = 'request_list_drivergetjob';

        // Table's primary key
        $primaryKey = 'm_autoid';

        $columns = [
            ['db'       => 'm_formno', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    $output = '
                    <a href="' . base_url('backend/admin/request_viewfull_page/') . $d . '" class="select_formno"
                    ><b>' . $d . '</b></a>
                    ';
                    return $output;
                },
            ],
            ['db'       => 'm_datetimecreate', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'mem_fullname', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'mem_tel', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_origininput', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_destinationinput', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_cartype', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'm_totalprice', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    return number_format($d, 2);
                },
            ],
            ['db'       => 'm_status', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    $class = "";
                    if ($d == "Open") {
                        $class = "class='cardstatus_Open'";
                    } else if ($d == "Approved" || $d == "Payment Confirmed" || $d == "Payment Checked" || $d == "Driver Get Job" ||
                        $d == "Driver Check In" || $d == "Driver Start Job" || $d == "Driver Check In Destination") {
                        $class = "class='cardstatus_Approve'";
                    } else if ($d == "Driver Close Job") {
                        $class = "class='cardstatus_Done'";
                    } else if ($d == "Not Approved" || $d == "User Cancel" || $d == "Driver Cancel") {
                        $class = "class='cardstatus_Done'";
                    }
                    $htlml = '<span ' . $class . '>' . $d . '</span>';
                    return $htlml;
                },
            ],
        ];

        // SQL server connection information
        $sql_details = [
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_name,
            'host' => getDb()->db_host,
        ];

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require 'server-side/scripts/ssp.class.php';

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, null)
        );
    }

    public function saveApproveDoc()
    {
        if (! empty($this->input->post("formno")) && ! empty($this->input->post("depositpercen")) && ! empty($this->input->post("deposit"))) {
            $formno        = $this->input->post("formno");
            $depositpercen = $this->input->post("depositpercen");
            $deposit       = $this->input->post("deposit");
            $memo          = $this->input->post("memo");
            $m_am1_approve = $this->input->post("m_am1_approve");

            if ($m_am1_approve == "อนุมัติ") {
                $m_status = "Approved";
            } else {
                $m_status = "Not Approved";
            }

            $arraySave = [
                "m_deposit_percen" => $depositpercen,
                "m_deposit"        => $deposit,
                "m_am1_memo"       => $memo,
                "m_status"         => $m_status,
                "m_am1_approve"    => $m_am1_approve,
                "m_am1_user"       => $this->session->am_fname . " " . $this->session->am_lname,
                "m_am1_datetime"   => date("Y-m-d H:i:s"),
            ];
            $this->db->where("m_formno", $formno);
            $this->db->update("main", $arraySave);

            $message  = "🚩 รายการของท่านได้รับการอนุมัติแล้ว \n กรุณาโอนเงินค่ามัดจำและยืนยันการชำระเงิน เพื่อเริ่มงาน \n✅ ตรวจสอบรายการ <a>$formno</a> \n";
            $token    = $this->session->accesstoken;
            $response = sendLineNotify($message, $token);

            $output = [
                "msg"    => "บันทึกการอนุมัติรายการสำเร็จ",
                "status" => "Update Data Success",
            ];
        } else {
            $output = [
                "msg"    => "บันทึกรายการไม่สำเร็จ",
                "status" => "Update Data Not Success",
            ];
        }
        echo json_encode($output);
    }

    public function getDataApproved()
    {
        if (! empty($this->input->post("formno"))) {
            $formno = $this->input->post("formno");
            $sql    = $this->db->query("SELECT
            m_deposit_percen,
            m_deposit,
            m_am1_approve,
            m_am1_memo,
            m_am1_user,
            DATE_FORMAT(m_am1_datetime , '%d-%m-%Y %H:%i:%s')AS m_am1_datetime
            FROM main WHERE m_formno = '$formno'
            ");

            $output = [
                "msg"    => "ดึงข้อมูลการ Approve สำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->row(),
            ];
        } else {
            $output = [
                "msg"    => "ดึงข้อมูลการ Approve ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            ];
        }
        echo json_encode($output);
    }

    public function getDataConfirmPay()
    {
        if (! empty($this->input->post("formno"))) {
            $formno = $this->input->post("formno");

            $sql = $this->db->query("SELECT
            main.m_userconfirm_money
            FROM
            main
            WHERE main.m_formno = ?
            ", [$formno]);

            $sqlFile = $this->db->query("SELECT
            f_path,
            f_name
            FROM files WHERE f_formno = ?
            ", [$formno]);

            $output = [
                "msg"        => "ดึงข้อมูล User confirm pay สำเร็จ",
                "status"     => "Select Data Success",
                "result"     => $sql->row(),
                "resultFile" => $sqlFile->result(),
            ];
        } else {
            $output = [
                "msg"    => "ดึงข้อมูล User confirm pay ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            ];
        }
        echo json_encode($output);
    }

    public function saveConfirmPayChecked()
    {
        if (! empty($this->input->post("formno")) && ! empty($this->input->post("m_am2_approve"))) {
            $formno        = $this->input->post("formno");
            $m_am2_approve = $this->input->post("m_am2_approve");
            $m_am2_memo    = $this->input->post("m_am2_memo");

            $arsave_ConfirmPayChecked = [
                "m_am2_approve"  => $m_am2_approve,
                "m_am2_memo"     => $m_am2_memo,
                "m_am2_user"     => $this->session->am_fname . " " . $this->session->am_lname,
                "m_am2_datetime" => date("Y-m-d H:i:s"),
                "m_status"       => "Payment Checked",
            ];

            $this->db->where("m_formno", $formno);
            $this->db->update("main", $arsave_ConfirmPayChecked);

            $output = [
                "msg"    => "อัพเดตข้อมูลการอนุมัติรายการสำเร็จ",
                "status" => "Update Data Success",
            ];
        } else {
            $output = [
                "msg"    => "อัพเดตข้อมูลการอนุมัติรายการไม่สำเร็จ",
                "status" => "Update Data Not Success",
            ];
        }
        echo json_encode($output);
    }

    public function getDataConfirmPayChecked()
    {
        if (! empty($this->input->post("formno"))) {
            $formno = $this->input->post("formno");
            $sql    = $this->db->query("SELECT
            m_am2_approve,
            m_am2_memo,
            m_am2_user,
            DATE_FORMAT(m_am2_datetime , '%d-%m-%Y %H:%i:%s')AS m_am2_datetime
            FROM main WHERE m_formno = ?
            ", [$formno]);

            $output = [
                "msg"    => "ดึงข้อมูลรายการ ผ่านการตรวจสอบการโอนเงินสำเร็จ",
                "status" => "Select Data Success",
                "result" => $sql->row(),
            ];
        } else {
            $output = [
                "msg"    => "ดึงข้อมูลรายการ ผ่านการตรวจสอบการโอนเงิน ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            ];
        }
        echo json_encode($output);
    }

    public function getCheckInData()
    {
        if (! empty($this->input->post("formno"))) {
            $formno = $this->input->post("formno");

            $sql = $this->db->query("SELECT
            m_dv_user_checkin,
            DATE_FORMAT(m_dv_datetime_checkin , '%d-%m-%Y %H:%i:%s')AS m_dv_datetime_checkin,
            m_dv_checkin_lat,
            m_dv_checkin_lng
            FROM main WHERE m_formno = ?
            ", [$formno]);

            $drivername = getDriverData($sql->row()->m_dv_user_checkin)->dv_fname . " " . getDriverData($sql->row()->m_dv_user_checkin)->dv_lname;

            $output = [
                "msg"        => "ดึงข้อมูล CheckIn สำเร็จ",
                "status"     => "Select Data Success",
                "result"     => $sql->row(),
                "drivername" => $drivername,
            ];
        } else {
            $output = [
                "msg"    => "ดึงข้อมูล CheckIn ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            ];
        }

        echo json_encode($output);
    }

    public function getStartJobData()
    {
        if (! empty($this->input->post("formno"))) {
            $formno = $this->input->post("formno");
            $type   = $this->input->post("type");

            $sqlMain = $this->db->query("SELECT
            m_dv_user_start,
            -- m_dv_datetime_start,
            DATE_FORMAT(m_dv_datetime_start , '%d-%m-%Y %H:%i:%s')AS m_dv_datetime_start,
            m_dv_memo_start,
            m_dv_start_lat,
            m_dv_start_lng
            FROM main WHERE m_formno = ?
            ", [$formno]);

            $sqlFile = $this->db->query("SELECT
            f_path,
            f_name
            FROM files_dv WHERE f_formno = ? AND f_type = ?
            ", [$formno, $type]);

            $drivername = getDriverData($sqlMain->row()->m_dv_user_start)->dv_fname . " " . getDriverData($sqlMain->row()->m_dv_user_start)->dv_lname;

            $output = [
                "msg"          => "ดึงข้อมูล Start Job สำเร็จ",
                "status"       => "Select Data Success",
                "result_main"  => $sqlMain->row(),
                "result_files" => $sqlFile->result(),
                "drivername"   => $drivername,
            ];
        } else {
            $output = [
                "msg"    => "ดึงข้อมูล Start Job ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            ];
        }
        echo json_encode($output);
    }

    public function getCheckInDataDes()
    {
        if (! empty($this->input->post("formno"))) {
            $formno = $this->input->post("formno");

            $sql = $this->db->query("SELECT
            m_dv_user_checkindes,
            DATE_FORMAT(m_dv_datetime_checkindes , '%d-%m-%Y %H:%i:%s')AS m_dv_datetime_checkindes,
            m_dv_checkindes_lat,
            m_dv_checkindes_lng
            FROM main WHERE m_formno = ?
            ", [$formno]);

            $drivername = getDriverData($sql->row()->m_dv_user_checkindes)->dv_fname . " " . getDriverData($sql->row()->m_dv_user_checkindes)->dv_lname;

            $output = [
                "msg"        => "ดึงข้อมูล CheckIn Destination สำเร็จ",
                "status"     => "Select Data Success",
                "result"     => $sql->row(),
                "drivername" => $drivername,
            ];
        } else {
            $output = [
                "msg"    => "ดึงข้อมูล CheckIn Destination ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            ];
        }

        echo json_encode($output);
    }

    public function getStopJobData()
    {
        if (! empty($this->input->post("formno"))) {
            $formno = $this->input->post("formno");
            $type   = $this->input->post("type");

            $sqlMain = $this->db->query("SELECT
            m_dv_user_stop,
            -- m_dv_datetime_stop,
            DATE_FORMAT(m_dv_datetime_stop , '%d-%m-%Y %H:%i:%s')AS m_dv_datetime_stop,
            m_dv_memo_stop,
            m_dv_stop_lat,
            m_dv_stop_lng
            FROM main WHERE m_formno = ?
            ", [$formno]);

            $sqlFile = $this->db->query("SELECT
            f_path,
            f_name
            FROM files_dv WHERE f_formno = ? AND f_type = ?
            ", [$formno, $type]);

            $drivername = getDriverData($sqlMain->row()->m_dv_user_stop)->dv_fname . " " . getDriverData($sqlMain->row()->m_dv_user_stop)->dv_lname;

            $output = [
                "msg"          => "ดึงข้อมูล Start Job สำเร็จ",
                "status"       => "Select Data Success",
                "result_main"  => $sqlMain->row(),
                "result_files" => $sqlFile->result(),
                "drivername"   => $drivername,
            ];
        } else {
            $output = [
                "msg"    => "ดึงข้อมูล Start Job ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            ];
        }
        echo json_encode($output);
    }

    public function load_register_list_waitapprove()
    {
        // DB table to use
        $table = 'register_list_waitapprove';

        // Table's primary key
        $primaryKey = 'dv_autoid';

        $columns = [
            ['db'       => 'dv_registerno', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    $output = '
                    <a href="' . base_url('backend/admin/register_viewfull/') . $d . '" class="select_formno"
                    ><b>' . $d . '</b></a>
                    ';
                    return $output;
                },
            ],
            ['db'       => 'dv_register_datetime', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_fullname', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_tel', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_number_plate', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_status', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
        ];

        // SQL server connection information
        $sql_details = [
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_name,
            'host' => getDb()->db_host,
        ];

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require 'server-side/scripts/ssp.class.php';

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, null)
        );
    }

    public function load_register_list_active()
    {
        // DB table to use
        $table = 'register_list_active';

        // Table's primary key
        $primaryKey = 'dv_autoid';

        $columns = [
            ['db'       => 'dv_registerno', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    $output = '
                    <a href="' . base_url('backend/admin/register_viewfull/') . $d . '" class="select_formno"
                    ><b>' . $d . '</b></a>
                    ';
                    return $output;
                },
            ],
            ['db'       => 'dv_register_datetime', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_fullname', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_tel', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_number_plate', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_status', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
        ];

        // SQL server connection information
        $sql_details = [
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_name,
            'host' => getDb()->db_host,
        ];

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require 'server-side/scripts/ssp.class.php';

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, null)
        );
    }

    public function load_register_list_notapprove()
    {
        // DB table to use
        $table = 'register_list_notapprove';

        // Table's primary key
        $primaryKey = 'dv_autoid';

        $columns = [
            ['db'       => 'dv_registerno', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    $output = '
                    <a href="' . base_url('backend/admin/register_viewfull/') . $d . '" class="select_formno"
                    ><b>' . $d . '</b></a>
                    ';
                    return $output;
                },
            ],
            ['db'       => 'dv_register_datetime', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_fullname', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_tel', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_number_plate', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'dv_status', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
        ];

        // SQL server connection information
        $sql_details = [
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_name,
            'host' => getDb()->db_host,
        ];

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require 'server-side/scripts/ssp.class.php';

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, null)
        );
    }

    public function get_registerdata_viewfull($registerNo)
    {
        if (! empty($registerNo)) {
            $sql = $this->db->query("SELECT
            dv_registerno,
            dv_username,
            dv_password,
            dv_fnameth,
            dv_lnameth,
            dv_lineid,
            dv_tel,
            dv_number_plate,
            dv_status
            FROM member_drivers WHERE dv_registerno = ?
            ", [$registerNo]);

            if ($sql->num_rows() > 0) {
                return $sql->row();
            }
        }
    }

    public function getRegisterData()
    {
        if (! empty($this->input->post("registerNo"))) {
            $registerNo = $this->input->post("registerNo");
            $doc1       = $this->getRegisterFile($registerNo, "doc1");
            $doc2       = $this->getRegisterFile($registerNo, "doc2");
            $doc3       = $this->getRegisterFile($registerNo, "doc3");
            $doc4       = $this->getRegisterFile($registerNo, "doc4");

            $sql = $this->db->query("SELECT
            dv_username,
            dv_fnameth,
            dv_lnameth,
            dv_tel,
            dv_number_plate,
            DATE_FORMAT(dv_register_datetime , '%d-%M-%Y %H:%i:%s') AS dv_register_datetime,
            DATE_FORMAT(dv_active_datetime , '%d-%M-%Y %H:%i:%s') AS dv_active_datetime,
            dv_approve_status,
            dv_approve_memo,
            dv_status
            FROM member_drivers WHERE dv_registerno = ?
            ", [$registerNo]);

            $output = [
                "msg"          => "ดึงข้อมูลไฟล์สำเร็จ",
                "status"       => "Select Data Success",
                "doc1"         => $doc1->result(),
                "doc2"         => $doc2->result(),
                "doc3"         => $doc3->result(),
                "doc4"         => $doc4->result(),
                "registerdata" => $sql->row(),
            ];
        } else {
            $output = [
                "msg"    => "ดึงข้อมูลไฟล์ไม่สำเร็จ",
                "status" => "Select Data Not Success",
            ];
        }
        echo json_encode($output);
    }
    private function getRegisterFile($registerNo, $type)
    {
        if (! empty($registerNo) && ! empty($type)) {
            $sql = $this->db->query("SELECT
            f_registerno,
            f_driverusername,
            f_path,
            f_type,
            f_name
            FROM files_dv_member WHERE f_registerno = ? AND f_type = ?
            ", [$registerNo, $type]);

            return $sql;
        }
    }

    public function saveRegisterData()
    {
        if (! empty($this->input->post("registerNo")) && ! empty($this->input->post("approveChoice"))) {
            $registerNo    = $this->input->post("registerNo");
            $approveChoice = $this->input->post("approveChoice");
            $memo          = $this->input->post("memo");

            $approveStatus = "";
            if ($approveChoice == "อนุมัติ") {
                $approveStatus = "active";
            } else {
                $approveStatus = "not approve";
            }

            $arsave = [
                "dv_approve_memo"   => $memo,
                "dv_approve_status" => $approveChoice,
                "dv_status"         => $approveStatus,
            ];

            $this->db->where("dv_registerno", $registerNo);
            $this->db->update("member_drivers", $arsave);

            $output = [
                "msg"    => "อนุมัติรายการสำเร็จ",
                "status" => "Update Data Success",
            ];
        } else {
            $output = [
                "msg"    => "อนุมัติรายการไม่สำเร็จ",
                "status" => "Update Data Not Success",
            ];
        }

        echo json_encode($output);
    }

    public function saveSettingPrice()
    {
        if ($this->input->post("action") == "saveSettingPrice") {

            $cartype          = $this->input->post("cartype");
            $distance_x       = $this->input->post("distance_x");
            $fuel_consumption = $this->input->post("fuel_consumption");
            $fuel_pricerate   = $this->input->post("fuel_pricerate");
            $ratio_x          = $this->input->post("ratio_x");
            $money_plus       = $this->input->post("money_plus");
            $fnamedata        = $this->session->am_fname . " " . $this->session->am_lname;

            // เช็กว่ามี cartype นี้อยู่ในฐานข้อมูลแล้วหรือยัง
            $this->db->where('cartype', $cartype);
            $query = $this->db->get('setting_pricerate');

            if ($query->num_rows() > 0) {
                // มีค่าซ้ำในระบบ
                echo json_encode([
                    'status'  => 'duplicate',
                    'message' => 'มีข้อมูลประเภทรถนี้อยู่ในระบบแล้ว',
                ]);
                return; // ออกจาก function เลย
            }

            // ถ้าไม่มีซ้ำ ➔ เตรียมข้อมูลบันทึก
            $data = [
                'cartype'          => $cartype,
                'distance_x'       => $distance_x,
                'fuel_consumption' => $fuel_consumption,
                'fuel_pricerate'   => $fuel_pricerate,
                'ratio_x'          => $ratio_x,
                'money_plus'       => $money_plus,
                'user_create'      => $fnamedata,
                'datetime_create'  => date('Y-m-d H:i:s'),
                'last_update'      => date("Y-m-d H:i:s"),
            ];

            // บันทึกข้อมูล
            if ($this->db->insert('setting_pricerate', $data)) {
                echo json_encode([
                    'status'  => 'success',
                    'message' => 'บันทึกข้อมูลเรียบร้อยแล้ว',
                ]);
            } else {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                ]);
            }
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
            ]);
        }
    }

    public function loadPricerateList()
    {
        // DB table to use
        $table = 'pricerate_list';

        // Table's primary key
        $primaryKey = 'id';

        $columns = [
            ['db'       => 'name_th', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    return $d;
                },
            ],
            ['db'       => 'id', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    $distance_x       = $row['distance_x'];
                    $fuel_consumption = $row['fuel_consumption'];
                    $fuel_pricerate   = $row['fuel_pricerate'];
                    $ratio_x          = $row['ratio_x'];
                    $money_plus       = $row['money_plus'];
                    $html             = "";
                    $html .= "<p><span><b>ตัวคูณของระยะทาง : </b>$distance_x</span></p>";
                    $html .= "<p><span><b>อัตราการบริโภคน้ำมัน : </b></span>$fuel_consumption</p>";
                    $html .= "<p><span><b>เรทราคาน้ำมัน : </b></span>$fuel_pricerate</p>";
                    $html .= "<p><span><b>อัตราส่วน : </b></span>$ratio_x</p>";
                    $html .= "<p><span><b>เงินบวก : </b></span>$money_plus</p>";
                    return $html;
                },
            ],
            ['db'       => 'id', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    $html = '<button type="button" class="btn btn-sm btn-primary btn-edit"
                        data-id="' . $d . '"
                        data-distance_x="' . $row['distance_x'] . '"
                        data-fuel_consumption="' . $row['fuel_consumption'] . '"
                        data-fuel_pricerate="' . $row['fuel_pricerate'] . '"
                        data-ratio_x="' . $row['ratio_x'] . '"
                        data-money_plus="'.$row['money_plus'].'"
                        data-cartype="'.$row['cartype'].'"
                    >';
                    $html .= '<i class="fa fa-edit"></i> แก้ไข';
                    $html .= '</button>';
                    return $html;
                },
            ],

            // เพิ่มฟิลด์ที่ต้องการใช้งานใน $row ด้วย (dt ไม่ต้องซ้ำกับที่แสดง)
            ['db' => 'distance_x', 'dt' => null],
            ['db' => 'fuel_consumption', 'dt' => null],
            ['db' => 'fuel_pricerate', 'dt' => null],
            ['db' => 'ratio_x', 'dt' => null],
            ['db' => 'money_plus', 'dt' => null],
            ['db' => 'cartype', 'dt' => null],

        ];

        // SQL server connection information
        $sql_details = [
            'user' => getDb()->db_username,
            'pass' => getDb()->db_password,
            'db'   => getDb()->db_name,
            'host' => getDb()->db_host,
        ];

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * If you just want to use the basic configuration for DataTables with PHP
        * server-side, there is no need to edit below this line.
        */
        require 'server-side/scripts/ssp.class.php';

        echo json_encode(
            SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null, null)
        );
    }

    public function saveEditPricerate()
    {
        if($this->input->post("action") === "saveEditSettingPrice"){
            $cartype = $this->input->post("cartype");
            $distance_x = $this->input->post("distance_x");
            $fuel_consumption = $this->input->post("fuel_consumption");
            $fuel_pricerate = $this->input->post("fuel_pricerate");
            $ratio_x = $this->input->post("ratio_x");
            $money_plus = $this->input->post("money_plus");
            $id = $this->input->post("id");

            $fnamedata = $this->session->am_fname . " " . $this->session->am_lname;

            $data = array(
                "cartype" => $cartype,
                "distance_x" => $distance_x,
                "fuel_consumption" => $fuel_consumption,
                "ratio_x" => $ratio_x,
                "money_plus" => $money_plus,
                "user_update" => $fnamedata,
                "last_update" => date("Y-m-d H:i:s")
            );

            $this->db->where("id" , $id);
            if($this->db->update("setting_pricerate" , $data)){
                echo json_encode([
                    'status'  => 'success',
                    'message' => 'บันทึกข้อมูลเรียบร้อยแล้ว',
                ]);
            }else {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                ]);
            }
        }else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
            ]);
        }
    }


}

/* End of file Admin_model.php */
