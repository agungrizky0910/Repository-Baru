<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Apps'));
        $this->load->helper('users_helper');
    }

    public function index()
    {
        $tanggal = date('Y-m');
        $data['caddy_terbaik'] = $this->Apps->select_join_where_order_limit('t_laporan.total_skor, t_caddy.nama, t_caddy.foto', ['t_caddy.hapus' => '0', 't_laporan.periode_laporan' => $tanggal], 't_laporan', 't_caddy', 't_laporan.id_caddy = t_caddy.id_caddy', 't_laporan.total_skor', 'DESC', '3');
        $data['kinerja_caddy'] = $this->Apps->select_join_where_order('*', ['t_laporan.periode_laporan' => $tanggal], 't_laporan', 't_caddy', 't_laporan.id_caddy=t_caddy.id_caddy', 't_laporan.total_skor', 'DESC');
        $this->load->view('V_Home', $data);
    }
}
