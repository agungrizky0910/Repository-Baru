<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ForgotPassword extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Apps');
    }



    public function index()
    {
        function CodeGenerator($length = 5)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        if ($this->session->userdata('login') == TRUE) {
            if ($this->session->userdata('level') == 'CaddyMaster') {
                redirect('CaddyMaster');
            } else if ($this->session->userdata('level') == 'GOManager') {
                redirect('Manager');
            } else if ($this->session->userdata('level') == 'Admin') {
                redirect('Admin');
            }
        } else {
            if (!empty($_POST)) {
                //Validasi Email
                $this->form_validation->set_rules('email', 'EMAIL', 'trim|xss_clean|required');
                if ($this->form_validation->run() == TRUE) {
                    $this->form_validation->set_rules('email', 'EMAIL', 'valid_email');
                    if ($this->form_validation->run() == TRUE) {
                        $this->form_validation->set_rules('email', 'EMAIL', 'is_unique[t_user.email]');
                        if ($this->form_validation->run() == FALSE) {
                            $email = $this->input->post('email');
                            $code = CodeGenerator();
                            $tahun = date('Y');
                            $get = $this->Apps->get_where('t_user', array('email' => $email));
                            $user = $get->row();
                            $username = $user->username;

                            //Konfigurasi Email
                            $this->load->library('email');
                            $config['charset'] = 'utf-8';
                            $config['useragent'] = 'PT. Damai Indah Golf';
                            $config['mailpath'] = '/usr/sbin/sendmail'; // or '/usr/bin/sendmail'
                            $config['protocol'] = 'smtp';
                            $config['mailtype'] = 'html';
                            $config['smtp_crypto'] = 'ssl';
                            $config['smtp_host'] = 'smtp.gmail.com';
                            $config['smtp_port'] = '465';
                            $config['smtp_timeout'] = '5';
                            $config['smtp_user'] = 'help.damaiindahgolf@gmail.com'; //isi dengan email gmail
                            $config['smtp_pass'] = '!qwerty123'; //isi dengan password
                            $config['crlf'] = "\r\n";
                            $config['newline'] = "\r\n";
                            $config['wordwrap'] = TRUE;
                            $config['validation'] = TRUE;
                            $config['send_multipart'] = FALSE;
                            $config['priority']  = '1';
                            $config['smtp_auth'] = TRUE;
                            $this->email->initialize($config);

                            $this->email->from('help.damaiindahgolf@gmail.com', "PT. Damai Indah Golf");
                            $this->email->to($email);
                            $this->email->subject('Reset Password Akun - Damai Indah Golf');
                            $this->email->message('
							<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                            <html xmlns="http://www.w3.org/1999/xhtml">

                            <head>
                                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                <title>Verifikasi Alamat Email Anda</title>
                                <style type="text/css" rel="stylesheet" media="all">
                                    /* Base ------------------------------ */
                                    
                                    *:not(br):not(tr):not(html) {
                                        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                                        -webkit-box-sizing: border-box;
                                        box-sizing: border-box;
                                    }
                                    
                                    body {
                                        width: 100% !important;
                                        height: 100%;
                                        margin: 0;
                                        line-height: 1.4;
                                        background-color: #f5f7f9;
                                        color: #839197;
                                        -webkit-text-size-adjust: none;
                                    }
                                    
                                    a {
                                        color: #414ef9;
                                    }
                                    /* Layout ------------------------------ */
                                    
                                    .email-wrapper {
                                        width: 100%;
                                        margin: 0;
                                        padding: 0;
                                        background-color: #f5f7f9;
                                    }
                                    
                                    .email-content {
                                        width: 100%;
                                        margin: 0;
                                        padding: 0;
                                    }
                                    /* Masthead ----------------------- */
                                    
                                    .email-masthead {
                                        padding: 25px 0;
                                        text-align: center;
                                    }
                                    
                                    .email-masthead_logo {
                                        max-width: 400px;
                                        border: 0;
                                    }
                                    
                                    .email-masthead_name {
                                        font-size: 16px;
                                        font-weight: bold;
                                        color: #839197;
                                        text-decoration: none;
                                        text-shadow: 0 1px 0 white;
                                    }
                                    /* Body ------------------------------ */
                                    
                                    .email-body {
                                        width: 100%;
                                        margin: 0;
                                        padding: 0;
                                        border-top: 1px solid #e7eaec;
                                        border-bottom: 1px solid #e7eaec;
                                        background-color: #ffffff;
                                    }
                                    
                                    .email-body_inner {
                                        width: 570px;
                                        margin: 0 auto;
                                        padding: 0;
                                    }
                                    
                                    .email-footer {
                                        width: 570px;
                                        margin: 0 auto;
                                        padding: 0;
                                        text-align: center;
                                    }
                                    
                                    .email-footer p {
                                        color: #839197;
                                    }
                                    
                                    .body-action {
                                        width: 100%;
                                        margin: 30px auto;
                                        padding: 0;
                                        text-align: center;
                                    }
                                    
                                    .body-sub {
                                        margin-top: 25px;
                                        padding-top: 25px;
                                        border-top: 1px solid #e7eaec;
                                    }
                                    
                                    .content-cell {
                                        padding: 35px;
                                    }
                                    
                                    .align-right {
                                        text-align: right;
                                    }
                                    /* Type ------------------------------ */
                                    
                                    h1 {
                                        margin-top: 0;
                                        color: #292e31;
                                        font-size: 19px;
                                        font-weight: bold;
                                        text-align: left;
                                    }
                                    
                                    h2 {
                                        margin-top: 0;
                                        color: #292e31;
                                        font-size: 16px;
                                        font-weight: bold;
                                        text-align: left;
                                    }
                                    
                                    h3 {
                                        margin-top: 0;
                                        color: #292e31;
                                        font-size: 14px;
                                        font-weight: bold;
                                        text-align: left;
                                    }
                                    
                                    p {
                                        margin-top: 0;
                                        color: #839197;
                                        font-size: 16px;
                                        line-height: 1.5em;
                                        text-align: left;
                                    }
                                    
                                    p.sub {
                                        font-size: 12px;
                                    }
                                    
                                    p.center {
                                        text-align: center;
                                    }
                                    /* Buttons ------------------------------ */
                                    
                                    .button {
                                        display: inline-block;
                                        width: 200px;
                                        background-color: #414ef9;
                                        border-radius: 3px;
                                        color: #ffffff;
                                        font-size: 15px;
                                        line-height: 45px;
                                        text-align: center;
                                        text-decoration: none;
                                        -webkit-text-size-adjust: none;
                                        mso-hide: all;
                                    }
                                    
                                    .button--green {
                                        background-color: #28db67;
                                    }
                                    
                                    .button--red {
                                        background-color: #ff3665;
                                    }
                                    
                                    .button--blue {
                                        background-color: #414ef9;
                                    }
                                    /*Media Queries ------------------------------ */
                                    
                                    @media only screen and (max-width: 600px) {
                                        .email-body_inner,
                                        .email-footer {
                                            width: 100% !important;
                                        }
                                    }
                                    
                                    @media only screen and (max-width: 500px) {
                                        .button {
                                            width: 100% !important;
                                        }
                                    }
                                </style>
                            </head>

                            <body>
                                <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td align="center">
                                            <table class="email-content" width="100%" cellpadding="0" cellspacing="0">
                                                <!-- Logo -->
                                                <tr>
                                                    <td class="email-masthead">
                                                        <a class="email-masthead_name">Damai Indah Golf</a>
                                                    </td>
                                                </tr>
                                                <!-- Email Body -->
                                                <tr>
                                                    <td class="email-body" width="100%">
                                                        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0">
                                                            <!-- Body content -->
                                                            <tr>
                                                                <td class="content-cell">
                                                                    <h1>Reset Password Akun</h1>
                                                                    <p>
                                                                        Anda telah meminta untuk melakukan reset password pada akun ' . $username . ', silahkan klik tombol dibawah ini untuk reset password anda.
                                                                    </p>
                                                                    <!-- Action -->
                                                                    <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td align="center">
                                                                                <div>
                                                                                    <!--[if mso
                                                            ]><v:roundrect
                                                            xmlns:v="urn:schemas-microsoft-com:vml"
                                                            xmlns:w="urn:schemas-microsoft-com:office:word"
                                                            href="' . base_url() . 'ForgotPassword/Code/' . $code . '"
                                                            style="
                                                                height: 45px;
                                                                v-text-anchor: middle;
                                                                width: 200px;
                                                            "
                                                            arcsize="7%"
                                                            stroke="f"
                                                            fill="t"
                                                            >
                                                            <v:fill type="tile" color="#414EF9" />
                                                            <w:anchorlock />
                                                            <center
                                                                style="
                                                                color: #ffffff;
                                                                font-family: sans-serif;
                                                                font-size: 15px;
                                                                "
                                                            >
                                                                Reset Password
                                                            </center>
                                                            </v:roundrect><!
                                                        [endif]-->
                                                                                    <a style="color: #ffffff" href="' . base_url() . 'ForgotPassword/Code/' . $code . '" class="button button--blue">Reset Password</a
                                                        >
                                                        </div>
                                                    </td>
                                                    </tr>
                                                </table>
                                                <p>Terimakasih,<br />Team Support Damai Indah Golf</p>
                                                <!-- Sub copy -->
                                                <table class="body-sub">
                                                    <tr>
                                                    <td>
                                                        <p class="sub">
                                                        Jika Anda tidak merasa menggunakan fitur ini,
                                                        silahkan abaikan pesan ini.
                                                        </p>
                                                    </td>
                                                    </tr>
                                                </table>
                                                </td>
                                            </tr>
                                            </table>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>
                                            <table
                                            class="email-footer"
                                            align="center"
                                            width="570"
                                            cellpadding="0"
                                            cellspacing="0"
                                            >
                                            <tr>
                                                <td class="content-cell">
                                                <p class="sub center">
                                                    PT. Damai Indah Golf &copy; ' . $tahun . '
                                                </p>
                                                </td>
                                            </tr>
                                            </table>
                                        </td>
                                        </tr>
                                    </table>
                                    </td>
                                </tr>
                                </table>
                            </body>
                            </html>');
                            if ($this->email->send()) {
                                $data_reset['reset_key'] = $code;
                                $cond['email'] = $email;
                                if ($this->Apps->update('t_user', $data_reset, $cond)) {
                                    header("content-type: application/json");
                                    echo json_encode(array('msg' => 'SUCCESS_LOST'));
                                    exit(0);
                                }
                            } else {
                                header("content-type: application/json");
                                echo json_encode(array('msg' => 'FAIL_SEND_EMAIL'));
                                exit(0);
                            }
                        } else {
                            header("content-type: application/json");
                            echo json_encode(array('msg' => 'NO_FOUND_EMAIL'));
                            exit(0);
                        }
                    } else {
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'INVALID_EMAIL'));
                        exit(0);
                    }
                } else {
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'KOSONG'));
                    exit(0);
                }
            }
            $this->load->view('V_Forgot_Password');
        }
    }

    function code()
    {
        if ($this->session->userdata('login') == TRUE) {
            if ($this->session->userdata('level') == 'CaddyMaster') {
                redirect('CaddyMaster');
            } else if ($this->session->userdata('level') == 'GOManager') {
                redirect('Manager');
            } else if ($this->session->userdata('level') == 'Admin') {
                redirect('Admin');
            }
        }

        if ($this->uri->segment(3)) {
            $code = $this->uri->segment(3);
            $cek = $this->Apps->cek_code($code);
            if ($cek->num_rows() > 0) {

                if (!empty($_POST)) {
                    $this->form_validation->set_rules('password1', 'PASSWORD 1', 'trim|xss_clean|required');
                    $this->form_validation->set_rules('password2', 'PASSWORD 2', 'trim|xss_clean|required');
                    if ($this->form_validation->run() == TRUE) {
                        $this->form_validation->set_rules('password1', 'PASSWORD', 'min_length[6]');
                        if ($this->form_validation->run() == TRUE) {
                            $this->form_validation->set_rules('password2', 'PASSWORD', 'matches[password1]');
                            if ($this->form_validation->run() == TRUE) {
                                $password = $this->input->post('password1');
                                $set['password'] = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
                                $set['reset_key'] =  '';
                                $cond['reset_key'] = $code;
                                if ($this->Apps->update('t_user', $set, $cond)) {
                                    header("content-type: application/json");
                                    echo json_encode(array('msg' => 'SUCCESS_RESET'));
                                    exit(0);
                                } else {
                                    header("content-type: application/json");
                                    echo json_encode(array('msg' => 'FAIL_RESET'));
                                    exit(0);
                                }
                            } else {
                                header("content-type: application/json");
                                echo json_encode(array('msg' => 'PASS_NOT_SAME'));
                                exit(0);
                            }
                        } else {
                            header("content-type: application/json");
                            echo json_encode(array('msg' => 'SHORT_PASS'));
                            exit(0);
                        }
                    } else {
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'KOSONG'));
                        exit(0);
                    }
                }
                $data['code'] = $this->uri->segment(3);
                $this->load->view('V_Reset_Password', $data);
            } else {
                $this->output->set_status_header('404');
                $this->load->view('V_404');
            }
        } else {
            $this->output->set_status_header('404');
            $this->load->view('V_404');
        }
    }
}
