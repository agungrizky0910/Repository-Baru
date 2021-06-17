<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manager extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('Template', 'form_validation'));
        $this->load->model('Apps');
        $this->load->helper('users_helper');
        if ($this->session->userdata('level') != 'GOManager') {
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
        $data['periode_laporan'] = $this->Apps->get_select_where_group_order('periode_laporan', 't_laporan', ['stat_laporan' => 'LS'], 'periode_laporan', 'periode_laporan', 'ASC');
        $this->template->tampilan('admin/V_Dashboard_GOM', $data);
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
                redirect('Manager');
            }
        } else {
            $this->template->Error404();
        }
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
                redirect('Manager');
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
                redirect('Manager');
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
                                    //proses insert data
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
                redirect('Manager');
            }
        } else {
            $this->template->Error404();
        }
    }

    function alpha_dash_space($str)
    {
        return (!preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
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
            $row[] = '<a href="' . base_url() . 'Manager/DetailLaporanMenunggu/' . $bulan . '/' . $tahun . '/">
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


    function TampilDataDetailLaporanMenunggu()
    {
        $this->load->model('Laporan_Menunggu');
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        if (!empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $tanggal = $tahun . '-' . $bulan;
            $cari = $this->Apps->get_where('t_laporan', ['periode_laporan' => $tanggal]);
            if ($cari->num_rows() >= 1) {
                $tgl = $tahun . '-' . $bulan;
                $list = $this->Laporan_Menunggu->get_datatables($tgl);
                $data = array();
                $i = $_POST['start'];
                $output = '';
                foreach ($list as $datas) {
                    $i++;
                    $row = array();
                    $row[] = $i;
                    $row[] =  '<img src="' . base_url() . 'assets/images/profil/' . $datas->foto . '" class="mr-2" alt="image">';
                    $row[] = $datas->nama;
                    $row[] = $datas->nip;
                    $row[] = $datas->skor_absen;
                    $row[] = $datas->skor_turun;
                    $row[] = $datas->total_skor;
                    $row[] = '
                                <button type="button" class="btn btn-gradient-success btn-rounded btn-icon btn-rounded selesai" title="Penilaian Selesai" data-laporan="' . $datas->id_laporan . '" data-periode="' . $datas->periode_laporan . '" data-nama="' . $datas->nama . '"><i class="mdi mdi-check-outline md-24"></i></button>
                            
                        ';
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Laporan_Menunggu->count_all($tgl),
                    "recordsFiltered" => $this->Laporan_Menunggu->count_filtered($tgl),
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

    function LaporanMenunggu()
    {
        $data['title'] = 'Laporan Belum Disetujui';
        $this->template->tampilan('admin/V_Laporan_Menunggu', $data);
    }

    function DetailLaporanMenunggu()
    {
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        if (!empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $tanggal = $tahun . '-' . $bulan;
            $data['title'] = 'Detail Laporan Penilaian Menunggu';
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['periode'] = $tanggal;
            $this->template->tampilan('admin/V_Detail_Laporan_GOM', $data);
        } else {
            $this->template->Error404();
        }
    }

    function UpdateLaporanSelesai()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('id_laporan', 'ID', 'xss_clean|required|numeric');
            $this->form_validation->set_rules('periode', 'Periode', 'xss_clean|required');
            if ($this->form_validation->run() == TRUE) {
                $id = $this->input->post('id_laporan', TRUE);
                $periode = $this->input->post('periode', TRUE);
                $data_laporan = $this->Apps->get_where('t_laporan', ['id_laporan' => $id, 'periode_laporan' => $periode, 'stat_laporan' => 'LM']);
                $cek = $data_laporan->num_rows();
                if ($cek == 1) {
                    $this->Apps->update('t_laporan', ['stat_laporan' => 'LS'], ['id_laporan' => $id, 'periode_laporan' => $periode, 'stat_laporan' => 'LM']);

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


    function TampilDataLaporanSelesai()
    {
        $this->load->model('Laporan_Selesai');
        $list = $this->Laporan_Selesai->get_datatables();
        $data = array();
        $i = $_POST['start'];
        $output = '';
        foreach ($list as $datas) {
            $i++;
            $bulan = date('m', strtotime($datas->periode_laporan));
            $tahun = date('Y', strtotime($datas->periode_laporan));
            $row = array();
            $row[] = $i;
            $row[] = periode($datas->periode_laporan);
            $row[] = short_date($datas->tgl_dibuat);
            $row[] = $datas->total;
            $row[] = 'Selesai';
            $row[] = '<a href="' . base_url() . 'Manager/DetailLaporanSelesai/' . $bulan . '/' . $tahun . '/">
                        <button type="button" class="btn btn-gradient-success btn-rounded btn-icon mr-1" title="Lihat Laporan"><i class="mdi mdi-book-search-outline md-24"></i></button>
                    </a>
                        ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Laporan_Selesai->count_all(),
            "recordsFiltered" => $this->Laporan_Selesai->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    function TampilDataDetailLaporanSelesai()
    {
        $this->load->model('Detail_Laporan_Selesai');
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        if (!empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $tanggal = $tahun . '-' . $bulan;
            $cari = $this->Apps->get_where('t_laporan', ['periode_laporan' => $tanggal]);
            if ($cari->num_rows() >= 1) {
                $tgl = $tahun . '-' . $bulan;
                $list = $this->Detail_Laporan_Selesai->get_datatables($tgl);
                $data = array();
                $i = $_POST['start'];
                $output = '';
                foreach ($list as $datas) {
                    $i++;
                    $nip = encode($datas->nip);
                    $row = array();
                    $row[] = $i;
                    $row[] =  '<img src="' . base_url() . 'assets/images/profil/' . $datas->foto . '" class="mr-2" alt="image">';
                    $row[] = $datas->nama;
                    $row[] = $datas->nip;
                    $row[] = $datas->skor_absen;
                    $row[] = $datas->skor_turun;
                    $row[] = $datas->total_skor;
                    $row[] = '<a href="' . base_url() . 'Manager/CetakKinerja/' . $bulan . '/' . $tahun . '/' . $nip . '" target="_blank">
                        <button type="button" class="btn btn-gradient-success btn-rounded btn-icon mr-1" title="Cetak Laporan"><i class="mdi mdi-printer md-24"></i></button>
                    </a>
                        ';
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Detail_Laporan_Selesai->count_all($tgl),
                    "recordsFiltered" => $this->Detail_Laporan_Selesai->count_filtered($tgl),
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


    function LaporanSelesai()
    {
        $data['title'] = 'Laporan Sudah Disetujui';
        $this->template->tampilan('admin/V_Laporan_Selesai', $data);
    }

    function DetailLaporanSelesai()
    {
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        if (!empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $tanggal = $tahun . '-' . $bulan;
            $data['title'] = 'Detail Laporan Penilaian Selesai';
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['periode'] = $tanggal;
            $this->template->tampilan('admin/V_Detail_Laporan_Selesai_GOM', $data);
        } else {
            $this->template->Error404();
        }
    }
    function TampilDataKinerja()
    {
        $this->load->model('Kinerja');
        $tgl = $this->session->userdata('periode_kinerja');
        $list = $this->Kinerja->get_datatables($tgl);
        $data = array();
        $i = $_POST['start'];
        $output = '';
        foreach ($list as $datas) {
            $i++;
            if ($datas->total_skor < 550) {
                $catatan = "Mendapat SP";
            } else {
                $catatan = "Mendapat Insentif";
            }
            $periodes = strtotime($datas->periode_laporan);
            $tahun = date("Y", $periodes);
            $bulan = date("m", $periodes);
            $nip = encode($datas->nip);
            $row = array();
            $row[] = $i;
            $row[] = '<img src="' . base_url() . 'assets/images/profil/' . $datas->foto . '" class="mr-2" alt="image">';
            $row[] = $datas->nama;
            $row[] = $datas->nip;
            $row[] = $datas->total_skor;
            $row[] = periode($datas->periode_laporan);
            $row[] = $catatan;
            $row[] = '<a href="' . base_url() . 'Manager/DetailKinerja/' . $bulan . '/' . $tahun . '/' . $nip . '">
                        <button type="button" class="btn btn-gradient-success btn-rounded btn-icon mr-1" title="Lihat Kinerja"><i class="mdi mdi-book-search md-24"></i></button>
                      </a>
                        ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Kinerja->count_all($tgl),
            "recordsFiltered" => $this->Kinerja->count_filtered($tgl),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function FilterKinerja()
    {
        $tahun = $this->uri->segment(3);
        $bulan = $this->uri->segment(4);
        $tgl = $tahun . '-' . $bulan;
        $this->session->set_userdata(['periode_kinerja' => $tgl]);
        header("content-type: application/json");
        echo json_encode(array('msg' => 'SUCCESS'));
        exit(0);
    }

    function LaporanKinerja()
    {
        $data['title'] = 'Laporan Kinerja Caddy';
        $this->load->model('Kinerja');
        $data['periode_nilai'] = $this->Kinerja->get_periode();
        $this->session->set_userdata(['periode_kinerja' => date('Y-m')]);
        $this->template->tampilan('admin/V_Laporan_Kinerja', $data);
    }

    function DetailKinerja()
    {
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        $nip_caddy = $this->uri->segment(5);
        if (!empty($nip_caddy) || !empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $data['title'] = 'Detail Laporan Kinerja';
            $nip = decode($nip_caddy);
            $cari = $this->Apps->get_where('t_caddy', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                $periode = $tahun . '-' . $bulan;
                $data_caddy = $cari->row();
                $data_kinerja = $this->Apps->select_join_where('t_laporan.total_skor, t_nilai.total_absen, t_nilai.total_telat, t_nilai.total_alpa, t_nilai.total_sakit, t_nilai.total_turun, t_nilai.total_poor, t_nilai.total_average, t_nilai.total_good, t_nilai.total_excellent', ['t_nilai.id_caddy' => $data_caddy->id_caddy, 't_laporan.periode_laporan' => $periode], 't_laporan', 't_nilai', 't_laporan.id_caddy = t_nilai.id_caddy AND t_laporan.periode_laporan = t_nilai.periode');
                if ($data_kinerja->num_rows() > 0) {
                    $stat_laporan = $this->Apps->get_select_where('stat_laporan', 't_laporan', ['id_caddy' => $data_caddy->id_caddy, 'periode_laporan' => $periode])->row();
                    $data['stat'] = $stat_laporan->stat_laporan;
                    $data['nama_caddy'] = $data_caddy->nama;
                    $data['nip_caddy'] = $data_caddy->nip;
                    $data['foto'] = $data_caddy->foto;
                    $data['fp'] = $data_caddy->id_fingerprint;
                    $data['bergabung'] = $data_caddy->bergabung;
                    $data['kinerja'] = $data_kinerja;
                    $this->template->tampilan('admin/V_Detail_Kinerja', $data);
                } else {
                    $this->template->Error404();
                }
            } else {
                $this->template->Error404();
            }
        } else {
            $this->template->Error404();
        }
    }

    function CetakKinerja()
    {
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        $nip_caddy = $this->uri->segment(5);
        if (!empty($nip_caddy) || !empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $data['title'] = 'Detail Laporan Kinerja';
            $nip = decode($nip_caddy);
            $cari = $this->Apps->get_where('t_caddy', ['nip' => $nip]);
            if ($cari->num_rows() >= 1) {
                $periode = $tahun . '-' . $bulan;
                $data_caddy = $cari->row();
                $data_kinerja = $this->Apps->select_join_3_where('t_user.nama, t_laporan.periode_laporan, t_laporan.tgl_dibuat, t_laporan.no_laporan, t_laporan.id_user, t_laporan.total_skor, t_nilai.total_absen, t_nilai.total_telat, t_nilai.total_alpa, t_nilai.total_sakit, t_nilai.total_turun, t_nilai.total_poor, t_nilai.total_average, t_nilai.total_good, t_nilai.total_excellent', ['t_nilai.id_caddy' => $data_caddy->id_caddy, 't_laporan.periode_laporan' => $periode], 't_laporan', 't_nilai', 't_laporan.id_caddy = t_nilai.id_caddy AND t_laporan.periode_laporan = t_nilai.periode', 't_user', 't_laporan.id_user = t_user.id_user');
                if ($data_kinerja->num_rows() > 0) {
                    $data['nama_caddy'] = $data_caddy->nama;
                    $data['nip_caddy'] = $data_caddy->nip;
                    $data['foto'] = $data_caddy->foto;
                    $data['jk'] = $data_caddy->jk;
                    $data['fp'] = $data_caddy->id_fingerprint;
                    $data['bergabung'] = $data_caddy->bergabung;
                    $data['kinerja'] = $data_kinerja;
                    $data['bulan'] = $bulan;
                    $data['tahun'] = $tahun;

                    $this->load->view('admin/V_Cetak_Kinerja', $data);
                } else {
                    $this->template->Error404();
                }
            } else {
                $this->template->Error404();
            }
        } else {
            $this->template->Error404();
        }
    }

    function CetakSemua()
    {
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);
        $periode = $tahun . '-' . $bulan;
        if (!empty($bulan) && !empty($tahun) && is_numeric($bulan) && is_numeric($tahun)) {
            $data['title'] = 'Detail Laporan Kinerja';
            $cek_p = $this->Apps->get_where('t_laporan', ['stat_laporan' => 'LM', 'periode_laporan' => $periode])->num_rows();
            if ($cek_p == 0) {
                $data_kinerja = $this->Apps->select_join_4_where('t_caddy.id_fingerprint, t_caddy.bergabung, t_caddy.foto, t_caddy.jk, t_caddy.nama as nama_caddy, t_caddy.nip, t_user.nama as nama_CM, t_laporan.periode_laporan, t_laporan.tgl_dibuat, t_laporan.no_laporan, t_laporan.id_user, t_laporan.total_skor, t_nilai.total_absen, t_nilai.total_telat, t_nilai.total_alpa, t_nilai.total_sakit, t_nilai.total_turun, t_nilai.total_poor, t_nilai.total_average, t_nilai.total_good, t_nilai.total_excellent', 't_laporan', 't_nilai', 't_laporan.id_caddy = t_nilai.id_caddy AND t_laporan.periode_laporan = t_nilai.periode', 't_user', 't_laporan.id_user = t_user.id_user', 't_caddy', 't_nilai.id_caddy = t_caddy.id_caddy', ['t_laporan.periode_laporan' => $periode], 't_caddy.nama', 'ASC');
                if ($data_kinerja->num_rows() > 0) {
                    $data['kinerja'] = $data_kinerja;
                    $data['bulan'] = $bulan;
                    $data['tahun'] = $tahun;
                    $this->load->view('admin/V_Cetak_Semua_Kinerja', $data);
                } else {
                    $this->template->Error404();
                }
            } else {
                $this->template->Error404();
            }
        } else {
            $this->template->Error404();
        }
    }
}
