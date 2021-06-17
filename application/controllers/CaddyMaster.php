<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CaddyMaster extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('Template', 'form_validation', 'excel'));
        $this->load->helper('users_helper');
        $this->load->model(array('Apps'));
        if ($this->session->userdata('level') != 'CaddyMaster') {
            redirect('Login');
        }
    }

    function index()
    {
        $data['title'] = 'Home';
        $tanggal = date('Y-m');
        $p_tanggal = date('Y-m', strtotime(date('Y-m') . " -1 month"));
        $data['total_caddy'] = $this->Apps->get_select_where('count(id_caddy) as total', 't_caddy', ['hapus' => '0'])->row();
        $data['caddy_terbaik'] = $this->Apps->select_join_where_order_limit('max(t_laporan.total_skor) as top, t_caddy.nama', ['t_caddy.hapus' => '0', 't_laporan.periode_laporan' => $tanggal], 't_laporan', 't_caddy', 't_laporan.id_caddy = t_caddy.id_caddy', 't_caddy.nama', 'ASC', '1')->row();
        $data['kinerja'] = $this->Apps->get_select_where('COALESCE(SUM(total_skor),0) as totals', 't_laporan', ['periode_laporan' => $tanggal])->row();
        $data['p_kinerja'] = $this->Apps->get_select_where('COALESCE(SUM(total_skor),0) as totals', 't_laporan', ['periode_laporan' => $p_tanggal])->row();
        $tahun = date("Y");
        $jan = "$tahun-01";
        $feb = "$tahun-02";
        $mar = "$tahun-03";
        $apr = "$tahun-04";
        $mei = "$tahun-05";
        $jun = "$tahun-06";
        $jul = "$tahun-07";
        $agu = "$tahun-08";
        $sep = "$tahun-09";
        $okt = "$tahun-10";
        $nov = "$tahun-11";
        $des = "$tahun-12";
        //data cart
        $data['totalJan'] = $this->Apps->data_kinerja('periode_laporan', $jan)->row();
        $data['totalFeb'] = $this->Apps->data_kinerja('periode_laporan', $feb)->row();
        $data['totalMar'] = $this->Apps->data_kinerja('periode_laporan', $mar)->row();
        $data['totalApr'] = $this->Apps->data_kinerja('periode_laporan', $apr)->row();
        $data['totalMei'] = $this->Apps->data_kinerja('periode_laporan', $mei)->row();
        $data['totalJun'] = $this->Apps->data_kinerja('periode_laporan', $jun)->row();
        $data['totalJul'] = $this->Apps->data_kinerja('periode_laporan', $jul)->row();
        $data['totalAgu'] = $this->Apps->data_kinerja('periode_laporan', $agu)->row();
        $data['totalSep'] = $this->Apps->data_kinerja('periode_laporan', $sep)->row();
        $data['totalOkt'] = $this->Apps->data_kinerja('periode_laporan', $okt)->row();
        $data['totalNov'] = $this->Apps->data_kinerja('periode_laporan', $nov)->row();
        $data['totalDes'] = $this->Apps->data_kinerja('periode_laporan', $des)->row();
        $totalJan = $this->Apps->data_kinerja('periode_laporan', $jan)->row();
        $totalFeb = $this->Apps->data_kinerja('periode_laporan', $feb)->row();
        $totalMar = $this->Apps->data_kinerja('periode_laporan', $mar)->row();
        $totalApr = $this->Apps->data_kinerja('periode_laporan', $apr)->row();
        $totalMei = $this->Apps->data_kinerja('periode_laporan', $mei)->row();
        $totalJun = $this->Apps->data_kinerja('periode_laporan', $jun)->row();
        $totalJul = $this->Apps->data_kinerja('periode_laporan', $jul)->row();
        $totalAgu = $this->Apps->data_kinerja('periode_laporan', $agu)->row();
        $totalSep = $this->Apps->data_kinerja('periode_laporan', $sep)->row();
        $totalOkt = $this->Apps->data_kinerja('periode_laporan', $okt)->row();
        $totalNov = $this->Apps->data_kinerja('periode_laporan', $nov)->row();
        $totalDes = $this->Apps->data_kinerja('periode_laporan', $des)->row();
        $data['nilai'] = array($totalJan->total, $totalFeb->total, $totalMar->total, $totalApr->total, $totalMei->total, $totalJun->total, $totalJul->total, $totalAgu->total, $totalSep->total, $totalOkt->total, $totalNov->total, $totalDes->total);
        $poor = $this->Apps->get_select_where('SUM(total_poor) as total', 't_nilai', ['periode' => $tanggal])->row();
        $average = $this->Apps->get_select_where('SUM(total_average) as total', 't_nilai', ['periode' => $tanggal])->row();
        $good = $this->Apps->get_select_where('SUM(total_good) as total', 't_nilai', ['periode' => $tanggal])->row();
        $excellent = $this->Apps->get_select_where('SUM(total_excellent) as total', 't_nilai', ['periode' => $tanggal])->row();
        $total = $poor->total + $average->total + $good->total + $excellent->total;
	if($total == '0'){
	$total = '1';
	}
        $data['poor'] = ceil($poor->total / $total * 100);
        $data['average'] = ceil($average->total / $total * 100);
        $data['good'] = ceil($good->total / $total * 100);
        $data['excellent'] = ceil($excellent->total / $total * 100);
        $data['kinerja_caddy'] = $this->Apps->select_join_where('*', ['t_nilai.periode' => $tanggal], 't_nilai', 't_caddy', 't_nilai.id_caddy=t_caddy.id_caddy');
        $this->template->tampilan('admin/V_Dashboard_CM', $data);
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
                redirect('CaddyMaster');
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
                redirect('CaddyMaster');
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
                                        $nip = $users->nip;
                                        $config['upload_path'] = './assets/images/profil';
                                        $config['allowed_types'] = 'jpg|png|jpeg';
                                        $config['max_size'] = '1024';
                                        $config['file_name'] = $nip;
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
                redirect('CaddyMaster');
            }
        } else {
            $this->template->Error404();
        }
    }


    function DataCaddy()
    {
        $data['title'] = 'Data Caddy';

        $this->template->tampilan('admin/V_Data_Caddy', $data);
    }

    function Tampil_Data_Caddy()
    {
        $this->load->model('Caddy');
        $list = $this->Caddy->get_datatables();
        $data = array();
        $i = $_POST['start'];
        $output = '';
        foreach ($list as $datas) {
            $i++;
            if ($datas->hapus == '0') {
                $status_caddy = "Aktif";
            } else {
                $status_caddy = "Non-Aktif";
            }
            if ($datas->hapus == '0') {
                $aksi = '
                                <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon btn-rounded caddy_non_aktif" id="' . $datas->nip . '" data="' . $datas->nama . '" title="Non-Aktifkan Caddy"><i class="mdi mdi-account-remove md-24"></i></button>
                            ';
            } else {
                $aksi = '
                                    <button type="button" class="btn btn-gradient-success btn-rounded btn-icon btn-rounded caddy_aktif" id="' . $datas->nip . '" data="' . $datas->nama . '" title="Aktifkan Caddy"><i class="mdi mdi-account-check md-24"></i></button>
                                ';
            }
            $row = array();
            $row[] = $i;
            $row[] = '<img src="' . base_url() . 'assets/images/profil/' . $datas->foto . '" class="mr-2" alt="image">';
            $row[] = $datas->nama;
            $row[] = $datas->id_fingerprint;
            $row[] = $datas->nip;
            $row[] =  $status_caddy;
            $row[] = '
                        <a href="' . base_url() . 'CaddyMaster/DetailCaddy/' . encode($datas->nip) . '">
                            <button type="button" class="btn btn-gradient-primary btn-rounded btn-icon mr-1" title="Lihat Profil"><i class="mdi mdi-account-search md-24"></i></button>
                        </a>
                        <a href="' . base_url() . 'CaddyMaster/EditCaddy/' . encode($datas->nip) . '">
                            <button type="button" class="btn btn-gradient-warning btn-rounded btn-icon mr-1" title="Ubah Profil"><i class="mdi mdi-account-edit md-24"></i></button>
                        </a>
                        ' . $aksi;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Caddy->count_all(),
            "recordsFiltered" => $this->Caddy->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function DetailCaddy()
    {
        $data['title'] = 'Data Caddy';
        $nip_caddy = $this->uri->segment(3);
        if (!empty($nip_caddy)) {
            $nip = decode($nip_caddy);
            $cari = $this->Apps->get_where('t_caddy', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                $data['data_caddy'] = $cari;
                $this->template->tampilan('admin/V_Detail_Caddy', $data);
            } else {
                redirect('CaddyMaster');
            }
        } else {
            $this->template->Error404();
        }
    }

    function LoadGambar()
    {
        $nip_caddy = $this->uri->segment(3);
        if (!empty($nip_caddy)) {
            $nip = decode($nip_caddy);
            $cari = $this->Apps->get_where('t_caddy', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                foreach ($cari->result() as $gambar) {
                    $output = ' <img src="' . base_url() . 'assets/images/profil/' . $gambar->foto . '" class="img-fluid rounded-circle" style="width: 100px;height: 100px;">';
                }
                header("content-type: application/json");
                echo json_encode(array('hasil' => $output));
                exit(0);
            } else {
                redirect('CaddyMaster');
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
                redirect('CaddyMaster');
            }
        } else {
            $this->template->Error404();
        }
    }

    function EditCaddy()
    {
        $data['title'] = 'Edit Data Caddy';
        $nip_caddy = $this->uri->segment(3);
        $data['nip_encode'] = $nip_caddy;
        if (!empty($nip_caddy)) {
            $nip = decode($nip_caddy);
            $cari = $this->Apps->get_where('t_caddy', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                $data['data_caddy'] = $cari;
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'xss_clean|required');
                    $this->form_validation->set_rules('email', 'Email', 'xss_clean|required');
                    $this->form_validation->set_rules('gender', 'Gender', 'xss_clean|required');
                    $this->form_validation->set_rules('tlp', 'Telepon', 'xss_clean|required');
                    $this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean|required');
                    $this->form_validation->set_rules('tgl', 'Tanggal Gabung', 'xss_clean|required');
                    if ($this->form_validation->run() == TRUE) {
                        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'min_length[3]|max_length[30]');
                        if ($this->form_validation->run() == TRUE) {
                            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|callback_alpha_dash_space');
                            if ($this->form_validation->run() == TRUE) {
                                $this->form_validation->set_rules('email', 'EMAIL', 'trim|valid_email');
                                if ($this->form_validation->run() == TRUE) {
                                    $this->form_validation->set_rules('alamat', 'Alamat', 'min_length[10]|max_length[255]');
                                    if ($this->form_validation->run() == TRUE) {
                                        //proses insert data caddy
                                        $profil = array(
                                            'nama' => ucwords(
                                                $this->input->post('nama', TRUE)
                                            ),
                                            'email' => $this->input->post('email', TRUE),
                                            'jk' => $this->input->post('gender', TRUE),
                                            'tlp' => $this->input->post('tlp', TRUE),
                                            'alamat' => $this->input->post('alamat', TRUE),
                                            'bergabung' => date('Y-m-d', strtotime($this->input->post('tgl', TRUE)))
                                        );
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
                                        $this->Apps->update('t_caddy', $profil, ['nip' => $nip]);
                                        header("content-type: application/json");
                                        echo json_encode(array('msg' => 'OK'));
                                        exit(0);
                                    } else {
                                        header("content-type: application/json");
                                        echo json_encode(array('msg' => 'SHORT_ALAMAT'));
                                        exit(0);
                                    }
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
                $this->template->tampilan('admin/V_Edit_Caddy', $data);
            } else {
                redirect('CaddyMaster');
            }
        } else {
            $this->template->Error404();
        }
    }

    function ActivedCaddy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('nip', 'NIP', 'xss_clean|required|min_length[10]|max_length[10]|numeric');
            if ($this->form_validation->run() == TRUE) {
                $nip = $this->input->post('nip', TRUE);
                $cek = $this->Apps->get_where('t_caddy', ['nip' => $nip, 'hapus' => '1'])->num_rows();
                if ($cek == 1) {
                    $this->Apps->update('t_caddy', ['hapus' => '0'], ['nip' => $nip, 'hapus' => '1']);
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


    function DeactivedCaddy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('nip', 'NIP', 'xss_clean|required|min_length[10]|max_length[10]|numeric');
            if ($this->form_validation->run() == TRUE) {
                $nip = $this->input->post('nip', TRUE);
                $cek = $this->Apps->get_where('t_caddy', ['nip' => $nip, 'hapus' => '0'])->num_rows();
                if ($cek == 1) {
                    $this->Apps->update('t_caddy', ['hapus' => '1'], ['nip' => $nip, 'hapus' => '0']);
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

    function AddCaddy()
    {
        $data['title'] = 'Tambah Data Caddy';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'xss_clean|required');
            $this->form_validation->set_rules('fingerprint', 'ID Fingerprint', 'xss_clean|required');
            $this->form_validation->set_rules('nip', 'NIP', 'xss_clean|required');
            $this->form_validation->set_rules('email', 'Email', 'xss_clean|required');
            $this->form_validation->set_rules('gender', 'Gender', 'xss_clean|required');
            $this->form_validation->set_rules('tlp', 'Telepon', 'xss_clean|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean|required');
            $this->form_validation->set_rules('tgl', 'Tanggal Gabung', 'xss_clean|required');

            if ($this->form_validation->run() == TRUE) {
                $this->form_validation->set_rules('nama', 'Nama Lengkap', 'min_length[3]|max_length[30]');
                if ($this->form_validation->run() == TRUE) {
                    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|callback_alpha_dash_space');
                    if ($this->form_validation->run() == TRUE) {
                        $this->form_validation->set_rules('fingerprint', 'Fingerprint', 'numeric');
                        if ($this->form_validation->run() == TRUE) {
                            $this->form_validation->set_rules('fingerprint', 'Fingerprint', 'is_unique[t_caddy.id_fingerprint]');
                            if ($this->form_validation->run() == TRUE) {
                                $this->form_validation->set_rules('nip', 'NIP', 'min_length[10]|max_length[10]|numeric');
                                if ($this->form_validation->run() == TRUE) {
                                    $this->form_validation->set_rules('nip', 'NIP', 'is_unique[t_caddy.nip]');
                                    if ($this->form_validation->run() == TRUE) {
                                        $this->form_validation->set_rules('email', 'EMAIL', 'trim|valid_email');
                                        if ($this->form_validation->run() == TRUE) {
                                            $this->form_validation->set_rules('tlp', 'Telepom', 'numeric');
                                            if ($this->form_validation->run() == TRUE) {
                                                $this->form_validation->set_rules('tlp', 'Telepon', 'min_length[8]|max_length[15]');
                                                if ($this->form_validation->run() == TRUE) {
                                                    $this->form_validation->set_rules('alamat', 'Alamat', 'min_length[10]|max_length[255]');
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
                                                                'id_fingerprint' => $this->input->post('fingerprint', TRUE),
                                                                'nip' => $this->input->post('nip', FALSE),
                                                                'nama' => ucwords(
                                                                    $this->input->post('nama', TRUE)
                                                                ),
                                                                'email' => $this->input->post('email', TRUE),
                                                                'jk' => $this->input->post('gender', TRUE),
                                                                'foto' => $gbr['file_name'],
                                                                'tlp' => $this->input->post('tlp', TRUE),
                                                                'alamat' => $this->input->post('alamat', TRUE),
                                                                'bergabung' => date('Y-m-d', strtotime($this->input->post('tgl', TRUE)))
                                                            );

                                                            $this->Apps->insert('t_caddy', $profil);
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
                                                        echo json_encode(array('msg' => 'SHORT_ALAMAT'));
                                                        exit(0);
                                                    }
                                                } else {
                                                    header("content-type: application/json");
                                                    echo json_encode(array('msg' => 'SHORT_TLP'));
                                                    exit(0);
                                                }
                                            } else {
                                                header("content-type: application/json");
                                                echo json_encode(array('msg' => 'INVALID_TLP'));
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
                                echo json_encode(array('msg' => 'NO_UNIQ_FP'));
                                exit(0);
                            }
                        } else {
                            header("content-type: application/json");
                            echo json_encode(array('msg' => 'INVALID_FP'));
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
        $this->template->tampilan('admin/V_Add_Caddy', $data);
    }

    function alpha_dash_space($str)
    {
        return (!preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    }

    function CheckFP()
    {
        if (isset($_POST['fingerprint'])) {
            $fingerprint = $_POST['fingerprint'];

            $fp_check = $this->Apps->get_where('t_caddy', ['id_fingerprint' => $fingerprint]);

            if ($fp_check->num_rows() >= 1) {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'FP-NO'));
                exit(0);
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'FP-OK'));
                exit(0);
            }
        } else {
            header("content-type: application/json");
            echo json_encode(array('msg' => 'FP-Error'));
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


    function AbsenCaddy()
    {
        $data['title'] = 'Data Absen Caddy';
        $data['absen'] = $this->Apps->get_where_order('t_caddy', ['hapus' => '0'], 'nama', 'ASC');
        $this->template->tampilan('admin/V_Absen_Caddy', $data);
    }

    function DetailAbsen()
    {
        $this->load->model('Absen_Caddy');
        $data['title'] = 'Detail Data Absen Caddy';
        $nip_caddy = $this->uri->segment(3);
        if (!empty($nip_caddy)) {
            $nip = decode($nip_caddy);
            $cari = $this->Apps->get_where('t_caddy', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                $this->session->set_userdata(['AbsenBulan' => '']);
                $this->session->set_userdata(['AbsenTahun' => '']);
                $data_caddy = $cari->row();
                $data['nama_caddy'] = $data_caddy->nama;
                $data['nip_caddy'] = $data_caddy->nip;
                $data['foto'] = $data_caddy->foto;
                $data['fp'] = $data_caddy->id_fingerprint;
                $data['tahun'] = $this->Absen_Caddy->get_periode($data_caddy->id_fingerprint);
                $bulan = $this->session->userdata('AbsenBulan');
                $tahun = $this->session->userdata('AbsenTahun');
                if (empty($bulan)) {
                    $this->session->set_userdata(['AbsenBulan' => date('m')]);
                    $bulan = $this->session->userdata('AbsenBulan');
                }
                if (empty($tahun)) {
                    $this->session->set_userdata(['AbsenTahun' => date('Y')]);
                    $tahun = $this->session->userdata('AbsenTahun');
                }
                $tanggal = $tahun . '-' . $bulan;
                $cari_total_absen = $this->Apps->select_get_like_where('COUNT(id_absen) as total', 't_absen', ['id_fingerprint' => $data_caddy->id_fingerprint, 'stat' => 'M'], 'tanggal', $tanggal)->row();
                $data['total_absen'] = $cari_total_absen->total;
                $cari_total_sakit = $this->Apps->select_get_like_where('COUNT(id_absen) as total_sakit', 't_absen', ['id_fingerprint' => $data_caddy->id_fingerprint, 'stat' => 'S'], 'tanggal', $tanggal)->row();
                $data['total_sakit'] = $cari_total_sakit->total_sakit;
                $this->template->tampilan('admin/V_Detail_Absen', $data);
            } else {
                redirect('CaddyMaster');
            }
        } else {
            $this->template->Error404();
        }
    }

    function FilterAbsen()
    {
        $this->load->model('Absen_Caddy');
        $fp = $this->uri->segment(3);
        $tanggal =
            $this->session->userdata('AbsenTahun') . '-'
            . $this->session->userdata('AbsenBulan');;
        $list = $this->Absen_Caddy->get_datatables($fp, $tanggal);
        $data = array();
        $i = $_POST['start'];
        $output = '';
        foreach ($list as $datas) {
            $i++;
            if ($datas->stat == 'M') {
                $jam_masuk = $datas->jam_masuk;
                $jam_telat = '08:05:00';
                if ($jam_masuk > $jam_telat) {
                    $status = 'Terlambat';
                } else {
                    $status = 'Masuk';
                }
            } else if ($datas->stat == 'S') {
                $status = 'Sakit';
            } else if ($datas->stat == 'A') {
                $status = 'Alpa';
            }
            $row = array();
            $row[] = $i;
            $row[] = short_date($datas->tanggal);
            $row[] = $datas->jam_masuk;
            $row[] = $status;
            $row[] = '
                         <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon btn-rounded hapus-absen" data="' . $datas->id_absen . '" title="Hapus Absen"><i class="mdi mdi-trash-can-outline md-24"></i></button>
                        ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Absen_Caddy->count_all($fp, $tanggal),
            "recordsFiltered" => $this->Absen_Caddy->count_filtered($fp, $tanggal),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function DeleteAbsen($id)
    {
        $this->load->model('Absen_Caddy');
        $this->Absen_Caddy->delete_by_id($id);
        header("content-type: application/json");
        echo json_encode(array('msg' => 'SUCCESS'));
        exit(0);
    }

    function DataDetailAbsen()
    {
        $fp = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        $bulan = $this->uri->segment(5);
        $this->session->set_userdata(['AbsenTahun' => $tahun]);
        $this->session->set_userdata(['AbsenBulan' => $bulan]);
        $tanggal = $tahun . '-' . $bulan;
        $cari_total_absen = $this->Apps->select_get_like_where('COUNT(id_absen) as total', 't_absen', ['id_fingerprint' => $fp, 'stat' => 'M'], 'tanggal', $tanggal)->row();
        $data['total_absen'] = $cari_total_absen->total;
        $cari_total_sakit = $this->Apps->select_get_like_where('COUNT(id_absen) as total_sakit', 't_absen', ['id_fingerprint' => $fp, 'stat' => 'S'], 'tanggal', $tanggal)->row();
        $data['total_sakit'] = $cari_total_sakit->total_sakit;
        echo json_encode(['total_absen' => $cari_total_absen->total, 'total_sakit' =>  $cari_total_sakit->total_sakit]);
    }

    function AddAbsen()
    {

        $data['title'] = 'Tambah Data Absen Caddy';

        $this->template->tampilan('admin/V_Add_Absen', $data);
    }

    function fetch()
    {
        $this->load->model('Excel_import_model');
        $ref_id = $this->db->query('SELECT MAX(no_ref) AS maxref FROM t_absen')->row();
        $no_ref = $ref_id->maxref;
        $data = $this->Excel_import_model->select('t_absen.tanggal,t_absen.jam_masuk,t_absen.stat,t_absen.id_fingerprint,t_caddy.nama,t_caddy.nip', ['t_absen.no_ref' => $no_ref], 't_absen', 't_caddy', 't_absen.id_fingerprint = t_caddy.id_fingerprint');

        $output = '<h5 align="center">Total Data - ' . $data->num_rows() . '</h5>
                    <table class="table table-striped table-bordered" width="100%">
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama</th>
                        <th class="text-center">NIP</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Jam Masuk</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">ID Fingerprint</th>
                    </tr>';
        $no = 1;
        foreach ($data->result() as $row) {
            if ($row->stat == 'M') {
                $stat = 'Masuk';
            } else if ($row->stat == 'S') {
                $stat = 'Sakit';
            } else if ($row->stat == 'A') {
                $stat = 'Alpa';
            }
            $output .= '
        <tr>
            <td class="text-center">' . $no . '</td>
            <td>' . $row->nama . '</td>
            <td class="text-center">' . $row->nip . '</td>
            <td class="text-center">' . short_date($row->tanggal) . '</td>
            <td class="text-center">' . $row->jam_masuk . '</td>
            <td class="text-center">' . $stat . '</td>
            <td class="text-center">' . $row->id_fingerprint . '</td>
         </tr>
      ';
            $no++;
        }

        $output .= '</table>';

        echo $output;
    }

    function import()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->model('Excel_import_model');
            $config['upload_path'] = './assets/tmp-upload/';
            $config['allowed_types'] = 'xls|xlsx';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                if (isset($_FILES["file"]["name"])) {
                    $path = $_FILES["file"]["tmp_name"];
                    $object = PHPExcel_IOFactory::load($path);
                    $ref_id = $this->db->query('SELECT MAX(no_ref) AS maxref FROM t_absen')->row();
                    $no_ref = $ref_id->maxref;
                    $no_ref++;
                    foreach ($object->getWorksheetIterator() as $worksheet) {
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $fingerprint = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $tanggal = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $arr_tanggal = explode("/", trim($tanggal));
                            $arr_jam = explode(":", trim($tanggal));
                            $tanggal_masuk = substr($arr_tanggal[2], 0, 4) . '-' . $arr_tanggal[1] . '-' . $arr_tanggal[0];
                            $jam_masuk = substr($arr_jam[0], -2) . ':' . $arr_jam[1] . ':' . $arr_jam[2];
                            $cek_absensi =  $this->Apps->get_where('t_absen', ['id_fingerprint' => $fingerprint, 'tanggal' => $tanggal_masuk, 'stat' => 'M']);
                            if ($cek_absensi->num_rows() >= 1) {
                                $this->Apps->delete('t_absen', ['id_fingerprint' => $fingerprint, 'tanggal' => $tanggal_masuk, 'stat' => 'M']);
                            }
                            $cek_tanggal = strtotime($tanggal_masuk);
                            $hari = date('D', $cek_tanggal);
                            $libur = 'Tue';
                            if ($hari != $libur) {
                                $cek_absen_sakit = $this->Apps->get_where('t_absen', ['id_fingerprint' => $fingerprint, 'tanggal' => $tanggal_masuk, 'stat' => 'S']);
                                if ($cek_absen_sakit->num_rows() == 0) {
                                    $data[] = array(
                                        'id_fingerprint'  => $fingerprint,
                                        'tanggal'   => $tanggal_masuk,
                                        'jam_masuk' => $jam_masuk,
                                        'stat' => 'M',
                                        'no_ref' => $no_ref
                                    );
                                }
                            }
                        }
                    }
                    $input_absen = array_unique($data, SORT_REGULAR);
                    $this->Excel_import_model->insert($input_absen);
                    $tmp_file = 'assets/tmp-upload/' . $_FILES["file"]["name"];
                    if (file_exists($tmp_file)) {
                        unlink($tmp_file);
                    }

                    //Input Alpa Check
                    $data_caddy = $this->Apps->get_where('t_caddy', ['hapus' => '0']);
                    foreach ($data_caddy->result() as $caddys) :
                        $get_absen_ref = $this->Apps->get_where_group('t_absen', ['no_ref' => $no_ref], 'tanggal', 'tanggal', 'ASC');
                        foreach ($get_absen_ref->result() as $absens) :
                            $check_alpa = $this->Apps->get_where('t_absen', ['tanggal' => $absens->tanggal, 'id_fingerprint' => $caddys->id_fingerprint]);
                            if ($check_alpa->num_rows() == 0) {
                                $this->Apps->insert('t_absen', ['id_fingerprint' => $caddys->id_fingerprint, 'tanggal' => $absens->tanggal, 'stat' => 'A', 'stat_nilai' => 'SN', 'no_ref' => $no_ref]);
                            }
                        endforeach;
                    endforeach;
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'SUCCESS'));
                    exit(0);
                }
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'FAIL_UPLOAD', 'err' => $this->upload->display_errors()));
                exit(0);
            }
        } else {
            $this->template->Error404();
        }
    }


    function hapus_absen()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('bulan', 'Bulan', 'xss_clean|required|numeric');
            $this->form_validation->set_rules('tahun', 'Tahun', 'xss_clean|required|numeric');
            if ($this->form_validation->run() == TRUE) {
                $bulan = $this->input->post('bulan');
                $tahun = $this->input->post('tahun');
                $periode = $tahun . '-' . $bulan;
                $cek_periode = $this->Apps->get_like('t_absen', 'tanggal', $periode);
                if ($cek_periode->num_rows() >= 1) {
                    $this->Apps->delete_like('t_absen', 'tanggal', $periode);
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'DELETE_OK'));
                    exit(0);
                } else {
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'EMPTY'));
                    exit(0);
                }
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'WORNG'));
                exit(0);
            }
        } else {
            $this->template->Error404();
        }
    }

    function AbsenSakit()
    {
        $data['title'] = 'Absen Sakit';

        $this->template->tampilan('admin/V_Absen_Sakit', $data);
    }

    function Tampil_Data_Caddy_Sakit()
    {
        $this->load->model('Caddy_Sakit');
        $list = $this->Caddy_Sakit->get_datatables();
        $data = array();
        $i = $_POST['start'];
        $output = '';
        foreach ($list as $datas) {
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = '<img src="' . base_url() . 'assets/images/profil/' . $datas->foto . '" class="mr-2" alt="image">';
            $row[] = $datas->nama;
            $row[] = $datas->nip;
            $row[] = short_date($datas->tanggal);
            $row[] = '
                         <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon btn-rounded hapus-absen" data="' . $datas->id_absen . '" data-nama="' . $datas->nama . '" title="Hapus Absen Sakit"><i class="mdi mdi-trash-can-outline md-24"></i></button>
                        ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Caddy_Sakit->count_all(),
            "recordsFiltered" => $this->Caddy_Sakit->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function DeleteAbsenSakit($id)
    {
        $this->load->model('Caddy_Sakit');
        $this->Caddy_Sakit->delete_by_id($id);
        header("content-type: application/json");
        echo json_encode(array('msg' => 'SUCCESS'));
        exit(0);
    }


    function AddAbsenSakit()
    {
        $data['title'] = 'Tambah Absen Sakit';
        $data['data_caddys'] = $this->Apps->get_where('t_caddy', ['hapus' => '0']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('caddy', 'Caddy', 'xss_clean|required|numeric');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $tanggal = $this->input->post('tanggal', TRUE);
                $fp = $this->input->post('caddy', TRUE);
                $cek_absen_sakit = $this->Apps->get_where('t_absen', ['tanggal' => $tanggal, 'id_fingerprint' => $fp, 'stat' => 'S']);
                if ($cek_absen_sakit->num_rows() == 0) {
                    $cek_absen_masuk = $this->Apps->get_where('t_absen', ['tanggal' => $tanggal, 'id_fingerprint']);
                    if ($cek_absen_masuk->num_rows() == 0) {
                        $this->Apps->insert('t_absen', ['tanggal' => $tanggal, 'id_fingerprint' => $fp, 'stat' => 'S', 'stat_nilai' => 'SN']);
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'Success'));
                        exit(0);
                    } else {
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'REPLACE'));
                        exit(0);
                    }
                } else {
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'SAME'));
                    exit(0);
                }
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'WORNG'));
                exit(0);
            }
        }
        $this->template->tampilan('admin/V_Add_Absen_Sakit', $data);
    }

    function TibanAbsenSakit()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('caddy', 'Caddy', 'xss_clean|required|numeric');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $tanggal = $this->input->post('tanggal', TRUE);
                $fp = $this->input->post('caddy', TRUE);
                $this->Apps->delete('t_absen', ['tanggal' => $tanggal, 'id_fingerprint' => $fp]);
                $this->Apps->insert('t_absen', ['tanggal' => $tanggal, 'id_fingerprint' => $fp, 'stat' => 'S', 'stat_nilai' => 'SN']);
                header("content-type: application/json");
                echo json_encode(array('msg' => 'Success'));
                exit(0);
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'WORNG'));
                exit(0);
            }
        } else {
            header("content-type: application/json");
            echo json_encode(array('msg' => 'NOPE'));
            exit(0);
        }
    }

    function TampilDataBelumDinilai()
    {
        $this->load->model('Nilai_Caddy');
        $tgl = $this->session->userdata('periode_nilai');
        $list = $this->Nilai_Caddy->get_datatables($tgl);
        $data = array();
        $i = $_POST['start'];
        $output = '';
        foreach ($list as $datas) {
            $i++;
            $hitung = $this->Apps->select_get_join_like_where('COUNT(t_absen.id_absen) as total', 't_absen', 't_caddy', 't_absen.id_fingerprint = t_caddy.id_fingerprint', ['t_absen.id_fingerprint' => $datas->id_fingerprint, 't_absen.stat' => 'M', 't_absen.stat_nilai' => 'BN'], 't_absen.tanggal', $datas->periode)->row();
            $periodes = strtotime($datas->periode);
            $tahun = date("Y", $periodes);
            $bulan = date("m", $periodes);
            $nip = encode($datas->nip);
            $row = array();
            $row[] = $i;
            $row[] = '<img src="' . base_url() . 'assets/images/profil/' . $datas->foto . '" class="mr-2" alt="image">';
            $row[] = $datas->nama;
            $row[] = $datas->nip;
            $row[] = periode($datas->periode);
            $row[] = $hitung->total;
            $row[] = '<a href="' . base_url() . 'CaddyMaster/DetailPenilaian/' . $bulan . '/' . $tahun . '/' . $nip . '">
                        <button type="button" class="btn btn-gradient-success btn-rounded btn-icon mr-1" title="Lihat Profil"><i class="mdi mdi-account-search md-24"></i></button>
                      </a>
                        ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Nilai_Caddy->count_all($tgl),
            "recordsFiltered" => $this->Nilai_Caddy->count_filtered($tgl),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function FilterBelumDiNilai()
    {
        $tahun = $this->uri->segment(3);
        $bulan = $this->uri->segment(4);
        $tgl = $tahun . '-' . $bulan;
        $this->session->set_userdata(['periode_nilai' => $tgl]);
        header("content-type: application/json");
        echo json_encode(array('msg' => 'SUCCESS'));
        exit(0);
    }


    function BelumDinilai()
    {
        $this->load->model('Nilai_Caddy');
        $data['title'] = 'Penilaian Belum Dinilai';
        $data['periode_nilai'] = $this->Nilai_Caddy->get_periode();
        $this->session->set_userdata(['periode_nilai' => date('Y-m')]);
        $this->template->tampilan('admin/V_Penilaian_Belum', $data);
    }


    function TampilDataDetailNilai()
    {
        $this->load->model('Detail_Nilai_Caddy');
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        $nip_caddy = $this->uri->segment(5);
        if (!empty($nip_caddy) && !empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $nip = decode($nip_caddy);
            $cari = $this->Apps->get_where('t_caddy', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                $data_caddys = $cari->row();
                $fp = $data_caddys->id_fingerprint;
                $tgl = $tahun . '-' . $bulan;
                $list = $this->Detail_Nilai_Caddy->get_datatables($fp, $tgl);
                $data = array();
                $i = $_POST['start'];
                $output = '';
                foreach ($list as $datas) {
                    $i++;
                    if ($datas->stat_nilai == 'BN') {
                        $stat = 'Belum Selesai';
                    } else if ($datas->stat_nilai == 'SN') {
                        $stat = 'Sudah Dinilai';
                    } else {
                        $stat = 'Selesai';
                    }
                    $row = array();
                    $row[] = $i;
                    $row[] = short_date($datas->tanggal);
                    $row[] = $stat;
                    $row[] = '<p>Excellent</p>
                            <p>Good</p>
                            <p>Average</p>
                            <p>Poor</p>';
                    $row[] = ' <input class="nilai" name="excellent" id="excellent' . $i . '" type="range" min="0" value="' . $datas->n_excellent . '" max="10" step="1" list="ticks" data-absen="' . $datas->id_absen . '" data-tipe="Excellent" oninput="OutputExcellent' . $i . '.value = excellent' . $i . '.value" /><br />
                            <output id="OutputExcellent' . $i . '" class="output">' . $datas->n_excellent . '</output><br>
                            <input class="nilai" name="good" id="good' . $i . '" type="range" min="0" value="' . $datas->n_good . '" max="10" step="1" list="ticks" data-absen="' . $datas->id_absen . '" data-tipe="Good" oninput="OutputGood' . $i . '.value = good' . $i . '.value" /><br />
                            <output id="OutputGood' . $i . '" class="output">' . $datas->n_good . '</output><br>
                            <input class="nilai" name="average" id="average' . $i . '" type="range" min="0" value="' . $datas->n_average . '" max="10" step="1" list="ticks" data-absen="' . $datas->id_absen . '" data-tipe="Average" oninput="OutputAverage' . $i . '.value = average' . $i . '.value" /><br />
                            <output id="OutputAverage' . $i . '" class="output">' . $datas->n_average . '</output><br>
                            <input class="nilai" name="poor" id="poor' . $i . '" type="range" min="0" value="' . $datas->n_poor . '" max="10" step="1" list="ticks" data-absen="' . $datas->id_absen . '" data-tipe="Poor" oninput="OutputPoor' . $i . '.value = poor' . $i . '.value" /><br />
                            <output id="OutputPoor' . $i . '" class="output">' . $datas->n_poor . '</output>';
                    $row[] = '
                                <button type="button" class="btn btn-gradient-success btn-rounded btn-icon btn-rounded selesai" title="Penilaian Selesai" data-absen="' . $datas->id_absen . '"><i class="mdi mdi-check-outline md-24"></i></button>
                            
                        ';
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Detail_Nilai_Caddy->count_all($fp, $tgl),
                    "recordsFiltered" => $this->Detail_Nilai_Caddy->count_filtered($fp, $tgl),
                    "data" => $data,
                );
                //output to json format
                echo json_encode($output);
            } else {
                $this->template->Error404();
            }
        } else {
            $this->template->Error404();
        }
    }

    function UpdateNilai()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('nilai', 'Nilai', 'xss_clean|required|numeric');
            $this->form_validation->set_rules('id_nilai', 'ID Nilai', 'xss_clean|required|numeric');
            $this->form_validation->set_rules('tipe', 'Tipe Nilai', 'xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $id = $this->input->post('id_nilai', TRUE);
                $nilai = $this->input->post('nilai', TRUE);
                $tipe = $this->input->post('tipe', TRUE);
                $cek = $this->Apps->get_where('t_absen', ['id_absen' => $id])->num_rows();
                if ($cek == 1) {
                    if ($tipe == 'Poor') {
                        $this->Apps->update('t_absen', ['n_poor' => $nilai], ['id_absen' => $id]);
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'SUCCESS'));
                        exit(0);
                    } else if ($tipe == 'Average') {
                        $this->Apps->update('t_absen', ['n_average' => $nilai], ['id_absen' => $id]);
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'SUCCESS'));
                        exit(0);
                    } else if ($tipe == 'Good') {
                        $this->Apps->update('t_absen', ['n_good' => $nilai], ['id_absen' => $id]);
                        header("content-type: application/json");
                        echo json_encode(array('msg' => 'SUCCESS'));
                        exit(0);
                    } else if ($tipe == 'Excellent') {
                        $this->Apps->update('t_absen', ['n_excellent' => $nilai], ['id_absen' => $id]);
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
        } else {
            header("content-type: application/json");
            echo json_encode(array('msg' => 'FAIL'));
            exit(0);
        }
    }

    function UpdateNilaiSelesai()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('id_absen', 'ID', 'xss_clean|required|numeric');
            $this->form_validation->set_rules('periode', 'Periode', 'xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $id = $this->input->post('id_absen', TRUE);
                $periode = $this->input->post('periode', TRUE);
                $data_absen = $this->Apps->get_where('t_absen', ['id_absen' => $id, 'stat_nilai' => 'BN']);
                $cek = $data_absen->num_rows();
                if ($cek == 1) {
                    $this->Apps->update('t_absen', ['stat_nilai' => 'SN'], ['id_absen' => $id, 'stat_nilai' => 'BN']);

                    //Ambil Data Caddy
                    $ambil_data = $data_absen->row();
                    $caddy = $this->Apps->get_select_where('id_caddy, id_fingerprint', 't_caddy', ['id_fingerprint' => $ambil_data->id_fingerprint])->row();

                    //Cek Tabel Nilai
                    $cek_penilaian = $this->Apps->get_where('t_nilai', ['id_caddy' => $caddy->id_caddy, 'periode' => $periode]);
                    if ($cek_penilaian->num_rows() != 1) {
                        $this->Apps->insert('t_nilai', ['id_caddy' => $caddy->id_caddy, 'periode' => $periode]);
                    }
                    //Hitung Data Tabel Nilai
                    $nilai = $this->Apps->select_get_like_where('SUM(n_poor) as poor, SUM(n_average) as average, SUM(n_good) as good, SUM(n_excellent) as excellent', 't_absen', ['id_fingerprint' => $caddy->id_fingerprint, 'stat' => 'M', 'stat_nilai' => 'SN'], 'tanggal', $periode)->row();
                    $t_poor = $nilai->poor;
                    $t_average = $nilai->average;
                    $t_good = $nilai->good;
                    $t_excellent = $nilai->excellent;
                    $t_turun = $t_poor + $t_average + $t_good + $t_excellent;

                    $jam_telat = '08:05:00';

                    //Hitung Absen Alpa
                    $alpa = $this->Apps->select_get_like_where('COUNT(stat) as alpa', 't_absen', ['id_fingerprint' => $caddy->id_fingerprint, 'stat_nilai' => 'SN', 'stat' => 'A'], 'tanggal', $periode)->row();
                    $t_alpa = $alpa->alpa;

                    //Hitung Absen Sakit
                    $sakit = $this->Apps->select_get_like_where('COUNT(stat) as sakit', 't_absen', ['id_fingerprint' => $caddy->id_fingerprint, 'stat_nilai' => 'SN', 'stat' => 'S'], 'tanggal', $periode)->row();
                    $t_sakit = $sakit->sakit;

                    //Hitung Absen Masuk
                    $absen = $this->Apps->select_get_like_where('COUNT(stat) as masuk', 't_absen', ['id_fingerprint' => $caddy->id_fingerprint, 'stat_nilai' => 'SN', 'stat' => 'M', 'jam_masuk <=' => $jam_telat], 'tanggal', $periode)->row();
                    $t_masuk = $absen->masuk;

                    //Hitung Absen Telat
                    $telat = $this->Apps->select_get_like_where('COUNT(stat) as telat', 't_absen', ['id_fingerprint' => $caddy->id_fingerprint, 'stat_nilai' => 'SN', 'stat' => 'M', 'jam_masuk >=' => $jam_telat], 'tanggal', $periode)->row();
                    $t_telat = $telat->telat;

                    $data = [
                        'total_absen' => $t_masuk,
                        'total_telat' => $t_telat,
                        'total_sakit' => $t_sakit,
                        'total_alpa' => $t_alpa,
                        'total_turun' => $t_turun,
                        'total_poor' => $t_poor,
                        'total_average' => $t_average,
                        'total_good' => $t_good,
                        'total_excellent' => $t_excellent
                    ];

                    $this->Apps->update('t_nilai', $data, ['id_caddy' => $caddy->id_caddy, 'periode' => $periode]);

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


    function DetailPenilaian()
    {
        $data['title'] = 'Detail Penilaian';
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        $nip_caddy = $this->uri->segment(5);
        if (!empty($nip_caddy) && !empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $nip = decode($nip_caddy);
            $cari = $this->Apps->get_where('t_caddy', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                $tanggal = $tahun . '-' . $bulan;
                $data_caddy = $cari->row();
                $data['bulan'] = $bulan;
                $data['tahun'] = $tahun;
                $data['nama_caddy'] = $data_caddy->nama;
                $data['nip_caddy'] = $data_caddy->nip;
                $data['foto'] = $data_caddy->foto;
                $data['fp'] = $data_caddy->id_fingerprint;
                $data['periode'] = $tanggal;
                $data['nip'] = $nip_caddy;
                $this->template->tampilan('admin/V_Detail_Penilaian', $data);
            } else {
                $this->template->Error404();
            }
        } else {
            $this->template->Error404();
        }
    }


    function TampilDataSudahDinilai()
    {
        $this->load->model('Nilai_Caddy_Selesai');
        $tgl = $this->session->userdata('periode_nilai');
        $list = $this->Nilai_Caddy_Selesai->get_datatables($tgl);
        $data = array();
        $i = $_POST['start'];
        $output = '';
        foreach ($list as $datas) {
            $i++;
            $hitung = $this->Apps->select_get_join_like_where('COUNT(t_absen.id_absen) as total', 't_absen', 't_caddy', 't_absen.id_fingerprint = t_caddy.id_fingerprint', ['t_absen.id_fingerprint' => $datas->id_fingerprint, 't_absen.stat' => 'M', 't_absen.stat_nilai' => 'SN'], 't_absen.tanggal', $datas->periode)->row();
            $periodes = strtotime($datas->periode);
            $tahun = date("Y", $periodes);
            $bulan = date("m", $periodes);
            $nip = encode($datas->nip);
            $row = array();
            $row[] = $i;
            $row[] = '<img src="' . base_url() . 'assets/images/profil/' . $datas->foto . '" class="mr-2" alt="image">';
            $row[] = $datas->nama;
            $row[] = $datas->nip;
            $row[] = periode($datas->periode);
            $row[] = $hitung->total;
            $row[] = '<a href="' . base_url() . 'CaddyMaster/DetailPenilaianSelesai/' . $bulan . '/' . $tahun . '/' . $nip . '">
                        <button type="button" class="btn btn-gradient-success btn-rounded btn-icon mr-1" title="Lihat Profil"><i class="mdi mdi-account-search md-24"></i></button>
                      </a>
                        ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Nilai_Caddy_Selesai->count_all($tgl),
            "recordsFiltered" => $this->Nilai_Caddy_Selesai->count_filtered($tgl),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function FilterSudahDiNilai()
    {
        $tahun = $this->uri->segment(3);
        $bulan = $this->uri->segment(4);
        $tgl = $tahun . '-' . $bulan;
        $this->session->set_userdata(['periode_nilai' => $tgl]);
        header("content-type: application/json");
        echo json_encode(array('msg' => 'SUCCESS'));
        exit(0);
    }

    function SudahDinilai()
    {
        $this->load->model('Nilai_Caddy_Selesai');
        $data['title'] = 'Penilaian Sudah Dinilai';
        $data['periode_nilai'] = $this->Nilai_Caddy_Selesai->get_periode();
        $this->session->set_userdata(['periode_nilai' => date('Y-m')]);
        $this->template->tampilan('admin/V_Penilaian_Sudah', $data);
    }


    function DetailPenilaianSelesai()
    {
        $data['title'] = 'Detail Penilaian Selesai';
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        $nip_caddy = $this->uri->segment(5);
        if (!empty($nip_caddy) && !empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $nip = decode($nip_caddy);
            $cari = $this->Apps->get_where('t_caddy', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                $tanggal = $tahun . '-' . $bulan;
                $data_caddy = $cari->row();
                $data['data_nilai'] = $this->Apps->select_get_like_where('*', 't_absen', ['stat' => 'M', 'stat_nilai' => 'SN', 'id_fingerprint' => $data_caddy->id_fingerprint], 'tanggal', $tanggal);
                $data['bulan'] = $bulan;
                $data['tahun'] = $tahun;
                $data['nama_caddy'] = $data_caddy->nama;
                $data['nip_caddy'] = $data_caddy->nip;
                $data['foto'] = $data_caddy->foto;
                $data['fp'] = $data_caddy->id_fingerprint;
                $data['periode'] = $tanggal;
                $this->template->tampilan('admin/V_Detail_Penilaian_Selesai', $data);
            } else {
                $this->template->Error404();
            }
        } else {
            $this->template->Error404();
        }
    }

    function BuatLaporan()
    {
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        if (!empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $tanggal = $tahun . "-" . $bulan;
            $cek_data = $this->Apps->select_get_like_where('id_absen', 't_absen', ['stat_nilai' => 'SN'], 'tanggal', $tanggal)->num_rows();
            if ($cek_data >= 1) {
                $cek = $this->Apps->select_get_like_where('id_absen', 't_absen', ['stat_nilai' => 'BN'], 'tanggal', $tanggal)->num_rows();
                if ($cek >= 1) {
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'BELUM-LENGKAP'));
                    exit(0);
                } else {
                    $caddy = $this->Apps->select_join_where('t_nilai.id_caddy', ['t_caddy.hapus' => '0', 't_nilai.periode' => $tanggal], 't_nilai', 't_caddy', 't_nilai.id_caddy=t_caddy.id_caddy');
                    foreach ($caddy->result() as $c) :
                        $cek_double = $this->Apps->get_select_where('id_laporan', 't_laporan', ['id_caddy' => $c->id_caddy, 'periode_laporan' => $tanggal]);
                        if ($cek_double->num_rows() > 0) {
                            $this->Apps->delete('t_laporan', ['id_caddy' => $c->id_caddy, 'periode_laporan' => $tanggal]);
                        }
                        $cari_nilai = $this->Apps->get_select_where('*', 't_nilai', ['id_caddy' => $c->id_caddy, 'periode' => $tanggal])->row();
                        $cek_no_lap = $this->Apps->select_get_like('id_laporan', 't_laporan', 'periode_laporan', $tanggal)->num_rows();
                        $s_masuk = $cari_nilai->total_absen / 26 * 100;
                        $s_alpa = $cari_nilai->total_alpa * -10;
                        $s_telat = $cari_nilai->total_telat * -5;
                        $s_turun = $cari_nilai->total_turun * 15;
                        $s_poor = $cari_nilai->total_poor * -10;
                        $s_average = $cari_nilai->total_average * 5;
                        $s_good = $cari_nilai->total_good * 10;
                        $s_excellent = $cari_nilai->total_excellent * 15;
                        $s_absen = $s_masuk + $s_alpa + $s_telat;
                        $s_player = $s_turun + $s_poor + $s_average + $s_good + $s_excellent;
                        $s_total = $s_absen + $s_player;
                        $no_laporan = $cek_no_lap + 1;
                        $no_lap = str_pad($no_laporan, 3, '0', STR_PAD_LEFT);
                        $thn = date('y', strtotime($tahun));
                        $kode_lap = $no_lap . "/FPK-MR/" . $bulan . "/" . $thn;
                        $data = [
                            'no_laporan' => $kode_lap,
                            'periode_laporan' => $tanggal,
                            'id_user' => $this->session->userdata('id_user'),
                            'id_caddy' => $c->id_caddy,
                            'skor_absen' => $s_absen,
                            'skor_turun' => $s_player,
                            'total_skor' => $s_total,
                            'tgl_dibuat' => date("Y-m-d"),
                            'stat_laporan' => "LM"
                        ];
                        $this->Apps->insert('t_laporan', $data);
                    endforeach;
                    header("content-type: application/json");
                    echo json_encode(array('msg' => 'SUCCESS'));
                    exit(0);
                }
            } else {
                header("content-type: application/json");
                echo json_encode(array('msg' => 'BELUM-ADA'));
                exit(0);
            }
        } else {
            $this->template->Error404();
        }
    }

    function TampilDataLaporan()
    {
        $this->load->model('Laporan');
        $list = $this->Laporan->get_datatables();
        $data = array();
        $i = $_POST['start'];
        $output = '';
        foreach ($list as $datas) {
            $i++;
            $bulan = date('m', strtotime($datas->periode_laporan));
            $tahun = date('Y', strtotime($datas->periode_laporan));
            $row = array();
            $row[] = $i;
            $row[] = $datas->nama;
            $row[] = periode($datas->periode_laporan);
            $row[] = short_date($datas->tgl_dibuat);
            $row[] = $datas->total;
            $row[] = 'Menunggu Persetujuan';
            $row[] = '<a href="' . base_url() . 'CaddyMaster/DetailLaporan/' . $bulan . '/' . $tahun . '/">
                        <button type="button" class="btn btn-gradient-success btn-rounded btn-icon mr-1" title="Lihat Laporan"><i class="mdi mdi-account-search md-24"></i></button>
                    </a>
                        ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Laporan->count_all(),
            "recordsFiltered" => $this->Laporan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    function Laporan()
    {
        $data['title'] = 'Laporan Penilaian';
        $this->load->model('Laporan');
        $data['periode_laporan'] = $this->Laporan->get_periode();
        $this->template->tampilan('admin/V_Laporan_CM', $data);
    }

    function DetailLaporan()
    {
        $data['title'] = 'Detail Laporan Penilaian';
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        if (!empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $tanggal = $tahun . '-' . $bulan;
            $cari = $this->Apps->get_where('t_laporan', ['periode_laporan' => $tanggal]);
            if ($cari->num_rows() >= 1) {
                $data_caddy = $cari->row();
                $data['data_laporan'] = $this->Apps->select_join_where_order('t_caddy.foto, t_caddy.nama, t_caddy.nip, t_laporan.skor_absen, t_laporan.skor_turun, t_laporan.total_skor', ['periode_laporan' => $tanggal, 'stat_laporan' => 'LM'], 't_caddy', 't_laporan', 't_caddy.id_caddy=t_laporan.id_caddy', 't_caddy.nama', 'ASC');
                $data['periode'] = $tanggal;
                $this->template->tampilan('admin/V_Detail_Laporan_CM', $data);
            } else {
                $this->template->Error404();
            }
        } else {
            $this->template->Error404();
        }
    }
}
