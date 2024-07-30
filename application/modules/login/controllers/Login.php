<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        date_default_timezone_set("Asia/bangkok");
        $this->load->model("login_model" , "login");
    }
    

    public function index()
    {
        $controller = $this->router->class;
        $data = array(
            "title" => "Login page"
        );
        if($this->session->userdata("ecode") == ""){
            getContent("loginpage" , $data);
        }else{
            if ($controller == "login"){
                header("refresh:0; url=" . base_url());
                exit();
            }else{
                $uri = isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe'] : '/intsys/msd_pulverizer';
                header('location:' . $uri);
            }
        }
        
    }


    public function checklogin()
    {
        $this->login->checklogin();
    }

    public function verifyuser()
    {
    $this->login->callLogin();
       $data = array(
           "title" => "Verify user page"
       );
       getContent("verifyuser" , $data);
       getFooter();
    }


    public function logout()
    {
        $this->login->logout();
    }

    public function test()
    {
        echo $this->login->getuser()->Fname;
    }

    public function save_verify()
    {
        // if($this->login->save_verify() == TRUE){
        //     header("refresh:0; url=".base_url());
        // }else{
        //     header("refresh:0; url=" . base_url('verifyuser.html'));
        // }
        $this->login->save_verify();
        header("refresh:0; url=".base_url());
    }

    public function getuserInMemberTable()
    {
        $this->login->getuserInMemberTable();
    }

    public function loginpage()
    {
        $clientId = 'U43e5cb93d915d611ca6d1cc07fbf5161';
        // $redirectUri = 'http://localhost/gt/login/line_callback';
        $redirectUri = get_urlcallback("เข้าสู่ระบบ")->cb_url_callback;
        $state = bin2hex(random_bytes(16));

        $lineLoginUrl = "https://notify-bot.line.me/oauth/authorize?response_type=code&client_id=$clientId&redirect_uri=$redirectUri&scope=notify&state=$state";
    }

    public function line_callback()
    {
        // Callback URL handler
        if (isset($_GET['code'])) {
            $code = $_GET['code'];

            $clientId = '2005934893'; // ใส่ Channel ID ที่ได้จาก LINE Developers Console
            $clientSecret = '971ec1ca05a49acb61dab03a1eea6645'; // ใส่ Channel Secret ที่ได้จาก LINE Developers Console
            $redirectUri = get_urlcallback("เข้าสู่ระบบ")->cb_url_callback;

            $tokenUrl = 'https://api.line.me/oauth2/v2.1/token';
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
            ];
            $data = [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $redirectUri,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $tokenUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $json = json_decode($response, true);

            if (isset($json['access_token'])) {
                $accessToken = $json['access_token'];

                // Get user profile
                $profileUrl = 'https://api.line.me/v2/profile';
                $headers = [
                    "Authorization: Bearer $accessToken",
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $profileUrl);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $profileResponse = curl_exec($ch);
                curl_close($ch);

                $profile = json_decode($profileResponse, true);

                // Do something with the user profile data
                $data = array(
                    "userId" => $profile['userId'],
                    "displayName" => $profile['displayName'],
                    "pictureUrl" => $profile['pictureUrl']
                );

                //check user activated
                $userId = $profile['userId'];
                $rsCheckuser = $this->login->checklogin($userId);

                if($rsCheckuser == "Not Have Data"){
                    $this->load->view("signupbyline" , $data);
                }else if($rsCheckuser == "Wait Allow Notify"){
                    $this->load->view("allowlinenotify");
                }else if($rsCheckuser == "User Activated"){
                    header("Location:".base_url());
                    exit(); 
                }
            }
        }

    }

    public function allowlinenotifypage()
    {
        $this->load->view("allowlinenotify");
    }

    public function linenotify_callback(){
        // Callback URL handler
        if (isset($_GET['code'])) {
            $code = $_GET['code'];

            $clientId = '46DuKmoJLVUuFMcWQerb1U'; // ใส่ Client ID ที่ได้จาก LINE Developers Console
            $clientSecret = 'OwGlA0mDHOoJtFzwPokHL5V4DZ2ZQEeKTa6NJxkj0x0'; // ใส่ Client Secret ที่ได้จาก LINE Developers Console
            $redirectUri = get_urlcallback("การแจ้งเตือนผ่านไลน์")->cb_url_callback; // ใส่ Callback URL ที่คุณตั้งค่าใน LINE Developers Console

            $tokenUrl = 'https://notify-bot.line.me/oauth/token';
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
            ];
            $data = [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $redirectUri,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $tokenUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $json = json_decode($response, true);

            if (isset($json['access_token'])) {
                $accessToken = $json['access_token'];
                $userId = $_SESSION['userId'];
                // เก็บ Access Token ในฐานข้อมูลสำหรับผู้ใช้แต่ละคน
                // $this->saveAccessToken($userId, $accessToken);
                $arsavedata = array(
                    "mem_line_accesstoken" => $accessToken,
                    "mem_status" => "User Activated"
                );
                $this->db->where("mem_line_userId" , $userId);
                $this->db->update("member" , $arsavedata);
                $_SESSION['accesstoken'] = $accessToken;

                header("Location:".base_url());
                exit(); 
            }
        }

    }


    public function saveSignup()
    {
        $this->login->saveSignup();
    }











}/* End of file Controllername.php */






?>