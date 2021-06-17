<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template
{

    function __construct()
    {
        $this->ci = &get_instance();
    }

    // function admin($template, $data='')
    // {

    //    $data['content'] = $this->ci->load->view($template, $data, TRUE);
    //    $data['nav']  = $this->ci->load->view('admin/nav_admin', $data, TRUE);
    //    $data['sidebar'] = $this->ci->load->view('admin/sidebar_admin', $data, TRUE);
    //    $data['header']  = $this->ci->load->view('admin/header_admin', $data, TRUE);
    //    $data['footer']  = $this->ci->load->view('admin/footer_admin', $data, TRUE);
    //    $this->ci->load->view('admin/dashboard', $data);

    // }

    function tampilan($template, $data = '')
    {
        $this->ci->load->model('apps');
        $data['header'] = $this->ci->load->view('admin/T_Head', $data, TRUE);
        $data['sidebar'] = $this->ci->load->view('admin/T_Sidebar', $data, TRUE);
        $data['footer'] = $this->ci->load->view('admin/T_Footer', $data, TRUE);
        $data['content'] = $this->ci->load->view($template, $data, TRUE);

        $this->ci->load->view('admin/T_Page', $data);
    }

    function Error404()
    {
        $this->ci->output->set_status_header('404');
        $this->ci->load->view('V_404');
    }
}
