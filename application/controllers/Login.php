<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Apps');
    }

    public function index()
    {
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
                //Validasi Login
                $this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');

                if ($this->form_validation->run() == TRUE) {
                    //input form login
                    $username   = $this->input->post('username', TRUE);
                    $pass       = $this->input->post('password', TRUE);

                    //Cek Data Login
                    $cek = $this->Apps->cek_user($username);
                    if ($cek->num_rows() > 0) {
                        $user = $cek->row();
                        if (password_verify($pass, $user->password)) {
                            if ($user->hapus == 0) {
                                if ($user->roll == 1) {
                                    $role = "CaddyMaster";
                                } else if ($user->roll == 2) {
                                    $role = "GOManager";
                                } else if ($user->roll == 3) {
                                    $role = "Admin";
                                }
                                $datauser = [
                                    'id_user' => $user->id_user,
                                    'user' => $user->username,
                                    'level' => $role,
                                    'nama' => $user->nama,
                                    'foto' => $user->foto,
                                    'login' => TRUE
                                ];
                                $this->session->set_userdata($datauser);
                                if ($user->roll == '1') {
                                    header("content-type: application/json");
                                    echo json_encode(array('msg' => 'CM'));
                                    exit(0);
                                } else if ($user->roll == '2') {
                                    header("content-type: application/json");
                                    echo json_encode(array('msg' => 'GOM'));
                                    exit(0);
                                } else if ($user->roll == '3') {
                                    header("content-type: application/json");
                                    echo json_encode(array('msg' => 'ADM'));
                                    exit(0);
                                }
                            } else {
                                header("content-type: application/json");
                                echo json_encode(array('msg' => 'OFF'));
                                exit(0);
                            }
                        } else {
                            header("content-type: application/json");
                            echo json_encode(array('msg' => 'PASSWORD_SALAH'));
                            exit(0);
                        }
                    } else {
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'USERNAME_SALAH'));
                        exit(0);
                    }
                } else {
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'KOSONG'));
                    exit(0);
                }
            }

            $this->load->view('V_Login');
        }
    }
}
