<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('Template', 'form_validation'));
        $this->load->helper('users_helper');
        $this->load->model(array('Apps'));
        if ($this->session->userdata('level') != 'Admin') {
            redirect('Login');
        }
    }

    function index()
    {
        $data['title'] = 'Data User';

        $this->template->tampilan('admin/V_Data_User', $data);
    }


    function RenderProfil()
    {
        $id = $this->session->userdata('id_user');
        if (!empty($id)) {
            $cari = $this->Apps->get_where('t_user', ['id_user' => $id]);
            if ($cari->num_rows() >= 1) {
                foreach ($cari->result() as $gambar) {
                    $output = '  <img src="' . base_url() . 'assets/images/profil/' . $gambar->foto . '" alt="profile">
                         <span class="login-status online"></span>';
                }
                header("content-type: application/json");
                echo json_encode(array('hasil' => $output));
                exit(0);
            } else {
                redirect('Admin');
            }
        } else {
            $this->template->Error404();
        }
    }

    function RenderNama()
    {
        $id = $this->session->userdata('id_user');
        if (!empty($id)) {
            $cari = $this->Apps->get_where('t_user', ['id_user' => $id]);
            if ($cari->num_rows() >= 1) {
                foreach ($cari->result() as $hasil) {
                    $output = custome_wordlimit($hasil->nama, 15);
                }
                header("content-type: application/json");
                echo json_encode(array('hasil' => $output));
                exit(0);
            } else {
                redirect('Admin');
            }
        } else {
            $this->template->Error404();
        }
    }

    function Profil()
    {
        $data['title'] = 'Edit Profil';
        $id = $this->session->userdata('id_user');
        if (!empty($id)) {
            $cari = $this->Apps->get_where('t_user', ['id_user' => $id]);
            if ($cari->num_rows() >= 1) {
                $data['data_user'] = $cari;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'xss_clean|required');
                    $this->form_validation->set_rules('email', 'Email', 'xss_clean|required');
                    if ($this->form_validation->run() == TRUE) {
                        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'min_length[3]|max_length[30]');
                        if ($this->form_validation->run() == TRUE) {
                            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|callback_alpha_dash_space');
                            if ($this->form_validation->run() == TRUE) {
                                $this->form_validation->set_rules('email', 'EMAIL', 'trim|valid_email');
                                if ($this->form_validation->run() == TRUE) {
                                    //proses insert data caddy
                                    $profil = array(
                                        'nama' => ucwords(
                                            $this->input->post('nama', TRUE)
                                        ),
                                        'email' => $this->input->post('email', TRUE),
                                    );
                                    if ($this->input->post('password1') != "") {
                                        $this->form_validation->set_rules('password1', 'PASSWORD 1', 'trim|xss_clean|required');
                                        $this->form_validation->set_rules('password2', 'PASSWORD 2', 'trim|xss_clean|required');
                                        if ($this->form_validation->run() == TRUE) {
                                            $this->form_validation->set_rules('password1', 'PASSWORD', 'min_length[6]');
                                            if ($this->form_validation->run() == TRUE) {
                                                $this->form_validation->set_rules('password2', 'PASSWORD', 'matches[password1]');
                                                if ($this->form_validation->run() == TRUE) {
                                                    $password = $this->input->post('password1');
                                                    $profil['password'] = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
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
                                    if ($_FILES['foto']['name'] != "") {
                                        $users = $cari->row();
                                        $user = $users->username;
                                        $config['upload_path'] = './assets/images/profil';
                                        $config['allowed_types'] = 'jpg|png|jpeg';
                                        $config['max_size'] = '1024';
                                        $config['file_name'] = $user;
                                        $this->load->library('upload', $config);
                                        if ($this->upload->do_upload('foto')) {
                                            $gbr = $this->upload->data();
                                            $profil['foto'] = $gbr['file_name'];
                                            $old_foto = $users->foto;
                                            $foto = "assets/images/profil/$old_foto";
                                            if (file_exists($foto)) {
                                                unlink($foto);
                                            }
                                            $this->session->set_userdata(['foto' => $gbr['file_name']]);
                                        } else {
                                            header("content-type: application/json");
                                            echo json_encode(array('msg' => 'FAIL_UPLOAD', 'err' => $this->upload->display_errors()));
                                            exit(0);
                                        }
                                    }
                                    $this->Apps->update('t_user', $profil, ['id_user' => $id]);
                                    $this->session->set_userdata(['nama' => custome_wordlimit(ucwords($this->input->post('nama', TRUE)), 15)]);

                                    header("content-type: application/json");
                                    echo json_encode(array('msg' => 'OK'));
                                    exit(0);
                                } else {
                                    header("content-type: application/json");
                                    echo json_encode(array('msg' => 'INVALID_EMAIL'));
                                    exit(0);
                                }
                            } else {
                                header("content-type: application/json");
                                echo json_encode(array('msg' => 'INVALID_NAME'));
                                exit(0);
                            }
                        } else {
                            header("content-type: application/json");
                            echo json_encode(array('msg' => 'SHORT_NAME'));
                            exit(0);
                        }
                    } else {
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'KOSONG'));
                        exit(0);
                    }
                }
                $this->template->tampilan('admin/V_Edit_Profil', $data);
            } else {
                redirect('Admin');
            }
        } else {
            $this->template->Error404();
        }
    }


    function Tampil_Data_User()
    {
        $this->load->model('User');
        $list = $this->User->get_datatables();
        $data = array();
        $i = $_POST['start'];
        $output = '';
        foreach ($list as $datas) {
            $i++;
            if ($datas->hapus == '0') {
                $status_user = "Aktif";
            } else {
                $status_user = "Non-Aktif";
            }
            if ($datas->hapus == '0') {
                $aksi = '
                                <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon btn-rounded user_non_aktif" id="' . $datas->nip . '" data="' . $datas->nama . '" title="Non-Aktifkan User"><i class="mdi mdi-account-remove md-24"></i></button>
                            ';
            } else {
                $aksi = '
                                    <button type="button" class="btn btn-gradient-success btn-rounded btn-icon btn-rounded user_aktif" id="' . $datas->nip . '" data="' . $datas->nama . '" title="Aktifkan User"><i class="mdi mdi-account-check md-24"></i></button>
                                ';
            }
            if ($datas->roll == "1") {
                $akses = "Caddy Master";
            } else if ($datas->roll == "2") {
                $akses = "Golf Operational Manager";
            } else {
                $akses = "Administrator";
            }
            $row = array();
            $row[] = $i;
            $row[] = '<img src="' . base_url() . 'assets/images/profil/' . $datas->foto . '" class="mr-2" alt="image">';
            $row[] = $datas->nama;
            $row[] = $datas->nip;
            $row[] = $akses;
            $row[] =  $status_user;
            $row[] = '
                        <a href="' . base_url() . 'Admin/DetailUser/' . encode($datas->nip) . '">
                            <button type="button" class="btn btn-gradient-primary btn-rounded btn-icon mr-1" title="Lihat Profil"><i class="mdi mdi-account-search md-24"></i></button>
                        </a>
                        <a href="' . base_url() . 'Admin/EditUser/' . encode($datas->nip) . '">
                            <button type="button" class="btn btn-gradient-warning btn-rounded btn-icon mr-1" title="Ubah Profil"><i class="mdi mdi-account-edit md-24"></i></button>
                        </a>
                        ' . $aksi;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->User->count_all(),
            "recordsFiltered" => $this->User->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function DetailUser()
    {
        $data['title'] = 'Data User';
        $nip_user = $this->uri->segment(3);
        if (!empty($nip_user)) {
            $nip = decode($nip_user);
            $cari = $this->Apps->get_where('t_user', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                $data['data_caddy'] = $cari;
                $this->template->tampilan('admin/V_Detail_User', $data);
            } else {
                redirect('Admin');
            }
        } else {
            $this->template->Error404();
        }
    }

    function LoadGambar()
    {
        $nip = $this->uri->segment(3);
        if (!empty($nip)) {
            $nip = decode($nip);
            $cari = $this->Apps->get_where('t_user', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                foreach ($cari->result() as $gambar) {
                    $output = ' <img src="' . base_url() . 'assets/images/profil/' . $gambar->foto . '" class="img-fluid rounded-circle" style="width:100px;height:100px;">';
                }
                header("content-type: application/json");
                echo json_encode(array('hasil' => $output));
                exit(0);
            } else {
                redirect('Admin');
            }
        } else {
            $this->template->Error404();
        }
    }

    function LoadProfil()
    {
        $id = $this->session->userdata('id_user');
        if (!empty($id)) {
            $cari = $this->Apps->get_where('t_user', ['id_user' => $id]);
            if ($cari->num_rows() >= 1) {
                foreach ($cari->result() as $gambar) {
                    $output = ' <img src="' . base_url() . 'assets/images/profil/' . $gambar->foto . '" class="img-fluid rounded-circle" style="width: 100px;height: 100px;">';
                }
                header("content-type: application/json");
                echo json_encode(array('hasil' => $output));
                exit(0);
            } else {
                redirect('Admin');
            }
        } else {
            $this->template->Error404();
        }
    }


    function ActivedUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('nip', 'NIP', 'xss_clean|required|min_length[10]|max_length[10]|numeric');
            if ($this->form_validation->run() == TRUE) {
                $nip = $this->input->post('nip', TRUE);
                $cek = $this->Apps->get_where('t_user', ['nip' => $nip, 'hapus' => '1'])->num_rows();
                if ($cek == 1) {
                    $this->Apps->update('t_user', ['hapus' => '0'], ['nip' => $nip, 'hapus' => '1']);
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'SUCCESS'));
                    exit(0);
                } else {
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'FAIL'));
                    exit(0);
                }
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'FAIL'));
                exit(0);
            }
        } else {
            header("content-type: application/json");
            echo json_encode(array('msg' => 'FAIL'));
            exit(0);
        }
    }


    function DeactivedUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('nip', 'NIP', 'xss_clean|required|min_length[10]|max_length[10]|numeric');
            if ($this->form_validation->run() == TRUE) {
                $nip = $this->input->post('nip', TRUE);
                $cek = $this->Apps->get_where('t_user', ['nip' => $nip, 'hapus' => '0'])->num_rows();
                if ($cek == 1) {
                    $this->Apps->update('t_user', ['hapus' => '1'], ['nip' => $nip, 'hapus' => '0']);
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'SUCCESS'));
                    exit(0);
                } else {
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'FAIL3'));
                    exit(0);
                }
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'FAIL2'));
                exit(0);
            }
        } else {
            header("content-type: application/json");
            echo json_encode(array('msg' => 'FAIL1'));
            exit(0);
        }
    }


    function EditUser()
    {
        $data['title'] = 'Edit Data User';
        $nip_user = $this->uri->segment(3);
        $data['nip_encode'] = $nip_user;
        if (!empty($nip_user)) {
            $nip = decode($nip_user);
            $cari = $this->Apps->get_where('t_user', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                $data['data_caddy'] = $cari;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'xss_clean|required');
                    $this->form_validation->set_rules('email', 'Email', 'xss_clean|required');
                    $this->form_validation->set_rules('level', 'Level', 'xss_clean|required');
                    if ($this->form_validation->run() == TRUE) {
                        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'min_length[3]|max_length[30]');
                        if ($this->form_validation->run() == TRUE) {
                            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|callback_alpha_dash_space');
                            if ($this->form_validation->run() == TRUE) {
                                //proses insert data caddy
                                $profil = array(
                                    'nama' => ucwords(
                                        $this->input->post('nama', TRUE)
                                    ),
                                    'email' => $this->input->post('email', TRUE),
                                    'roll' => $this->input->post('level', TRUE)
                                );
                                if ($this->input->post('password1') != "") {
                                    $this->form_validation->set_rules('password1', 'PASSWORD 1', 'trim|xss_clean|required');
                                    $this->form_validation->set_rules('password2', 'PASSWORD 2', 'trim|xss_clean|required');
                                    if ($this->form_validation->run() == TRUE) {
                                        $this->form_validation->set_rules('password1', 'PASSWORD', 'min_length[6]');
                                        if ($this->form_validation->run() == TRUE) {
                                            $this->form_validation->set_rules('password2', 'PASSWORD', 'matches[password1]');
                                            if ($this->form_validation->run() == TRUE) {
                                                $password = $this->input->post('password1');
                                                $profil['password'] = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
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
                                if ($_FILES['pasfoto']['name'] != "") {
                                    $config['upload_path'] = './assets/images/profil';
                                    $config['allowed_types'] = 'jpg|png|jpeg';
                                    $config['max_size'] = '1024';
                                    $config['file_name'] = $nip;
                                    $this->load->library('upload', $config);
                                    if ($this->upload->do_upload('pasfoto')) {
                                        $gbr = $this->upload->data();
                                        $profil['foto'] = $gbr['file_name'];
                                        foreach ($cari->result() as $hasil) {
                                            $old_foto = $hasil->foto;
                                            $foto = "assets/images/profil/$old_foto";
                                            if (file_exists($foto)) {
                                                unlink($foto);
                                            }
                                        }
                                    } else {
                                        header("content-type: application/json");
                                        echo json_encode(array('msg' => 'FAIL_UPLOAD', 'err' => $this->upload->display_errors()));
                                        exit(0);
                                    }
                                }
                                $this->Apps->update('t_user', $profil, ['nip' => $nip]);
                                header("content-type: application/json");
                                echo json_encode(array('msg' => 'OK'));
                                exit(0);
                            } else {
                                header("content-type: application/json");
                                echo json_encode(array('msg' => 'INVALID_NAME'));
                                exit(0);
                            }
                        } else {
                            header("content-type: application/json");
                            echo json_encode(array('msg' => 'SHORT_NAME'));
                            exit(0);
                        }
                    } else {
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'KOSONG'));
                        exit(0);
                    }
                }
                $this->template->tampilan('admin/V_Edit_User', $data);
            } else {
                redirect('CaddyMaster');
            }
        } else {
            $this->template->Error404();
        }
    }

    function AddUser()
    {
        $data['title'] = 'Tambah Data User';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'xss_clean|required');
            $this->form_validation->set_rules('username', 'Username', 'xss_clean|required');
            $this->form_validation->set_rules('nip', 'NIP', 'xss_clean|required');
            $this->form_validation->set_rules('email', 'Email', 'xss_clean|required');
            $this->form_validation->set_rules('level', 'Level', 'xss_clean|required');
            $this->form_validation->set_rules('password', 'Password', 'xss_clean|required');

            if ($this->form_validation->run() == TRUE) {
                $this->form_validation->set_rules('nama', 'Nama Lengkap', 'min_length[3]|max_length[30]');
                if ($this->form_validation->run() == TRUE) {
                    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|callback_alpha_dash_space');
                    if ($this->form_validation->run() == TRUE) {

                        $this->form_validation->set_rules('nip', 'NIP', 'min_length[10]|max_length[10]|numeric');
                        if ($this->form_validation->run() == TRUE) {
                            $this->form_validation->set_rules('nip', 'NIP', 'is_unique[t_caddy.nip]|is_unique[t_user.nip]');
                            if ($this->form_validation->run() == TRUE) {
                                $this->form_validation->set_rules('email', 'EMAIL', 'trim|valid_email');
                                if ($this->form_validation->run() == TRUE) {
                                    $this->form_validation->set_rules('username', 'username', 'min_length[6]|max_length[30]');
                                    if ($this->form_validation->run() == TRUE) {
                                        $this->form_validation->set_rules('username', 'Username', 'regex_match[/^[a-zA-Z0-9]+$/]');
                                        if ($this->form_validation->run() == TRUE) {
                                            $this->form_validation->set_rules('username', 'Username', 'is_unique[t_user.username]');
                                            if ($this->form_validation->run() == TRUE) {
                                                $this->form_validation->set_rules('password', 'Password', 'min_length[6]|max_length[30]');
                                                if ($this->form_validation->run() == TRUE) {
                                                    $config['upload_path'] = './assets/images/profil';
                                                    $config['allowed_types'] = 'jpg|png|jpeg';
                                                    $config['max_size'] = '1024';
                                                    $config['file_name'] = $this->input->post('nip');
                                                    $this->load->library('upload', $config);
                                                    if ($this->upload->do_upload('pasfoto')) {
                                                        $gbr = $this->upload->data();
                                                        //proses insert data item
                                                        $profil = array(
                                                            'username' => $this->input->post('username', TRUE),
                                                            'nip' => $this->input->post('nip', FALSE),
                                                            'nama' => ucwords(
                                                                $this->input->post('nama', TRUE)
                                                            ),
                                                            'email' => $this->input->post('email', TRUE),
                                                            'roll' => $this->input->post('level', TRUE),
                                                            'foto' => $gbr['file_name'],
                                                            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT, ['cost' => 10]),
                                                        );

                                                        $this->Apps->insert('t_user', $profil);
                                                        header("content-type: application/json");
                                                        echo json_encode(array('msg' => 'OK'));
                                                        exit(0);
                                                    } else {
                                                        header("content-type: application/json");
                                                        echo json_encode(array('msg' => 'FAIL_UPLOAD', 'err' => $this->upload->display_errors()));
                                                        exit(0);
                                                    }
                                                } else {
                                                    header("content-type: application/json");
                                                    echo json_encode(array('msg' => 'SHORT_PASSWORD'));
                                                    exit(0);
                                                }
                                            } else {
                                                header("content-type: application/json");
                                                echo json_encode(array('msg' => 'NO_UNIQ_USERNAME'));
                                                exit(0);
                                            }
                                        } else {
                                            header("content-type: application/json");
                                            echo json_encode(array('msg' => 'INVALID_USERNAME'));
                                            exit(0);
                                        }
                                    } else {
                                        header("content-type: application/json");
                                        echo json_encode(array('msg' => 'SHORT_USERNAME'));
                                        exit(0);
                                    }
                                } else {
                                    header("content-type: application/json");
                                    echo json_encode(array('msg' => 'INVALID_EMAIL'));
                                    exit(0);
                                }
                            } else {
                                header("content-type: application/json");
                                echo json_encode(array('msg' => 'NO_UNIQ_NIP'));
                                exit(0);
                            }
                        } else {
                            header("content-type: application/json");
                            echo json_encode(array('msg' => 'INVALID_NIP'));
                            exit(0);
                        }
                    } else {
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'INVALID_NAME'));
                        exit(0);
                    }
                } else {
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'SHORT_NAME'));
                    exit(0);
                }
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'KOSONG'));
                exit(0);
            }
        }
        $this->template->tampilan('admin/V_Add_User', $data);
    }

    function alpha_dash_space($str)
    {
        return (!preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    }

    function CheckUser()
    {
        if (isset($_POST['username'])) {
            $username = $this->input->post('username');

            $us_check = $this->Apps->get_where('t_user', ['username' => $username]);
            if ($us_check->num_rows() >= 1) {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'US-NO'));
                exit(0);
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'US-OK'));
                exit(0);
            }
        } else {
            header("content-type: application/json");
            echo json_encode(array('msg' => 'US-Error'));
            exit(0);
        }
    }

    function CheckNIP()
    {
        if (isset($_POST['nip'])) {
            $nip = $this->input->post('nip');

            $fp_check1 = $this->Apps->get_where('t_user', ['nip' => $nip]);
            $fp_check2 = $this->Apps->get_where('t_caddy', ['nip' => $nip]);
            if ($fp_check1->num_rows() >= 1 || $fp_check2->num_rows() >= 1) {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'NIP-NO'));
                exit(0);
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'NIP-OK'));
                exit(0);
            }
        } else {
            header("content-type: application/json");
            echo json_encode(array('msg' => 'NIP-Error'));
            exit(0);
        }
    }
}
