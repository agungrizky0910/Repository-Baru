<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_Selesai extends CI_Model
{
    var $select = array('COUNT(t_laporan.id_laporan) as total', 't_laporan.periode_laporan', 't_laporan.tgl_dibuat', 't_user.nama');
    var $table1 = 't_laporan';
    var $table2 = 't_user';
    var $index = 't_laporan.id_user=t_user.id_user';
    var $column_order = array('t_laporan.periode_laporan', 't_laporan.tgl_dibuat', 't_caddy.nama'); //set column field database for datatable orderable
    var $column_search = array('t_laporan.periode_laporan', 't_laporan.tgl_dibuat', 't_caddy.nama'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('t_laporan.periode_laporan' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        $this->db->select($this->select);
        $this->db->from($this->table1);
        $this->db->join($this->table2, $this->index);
        $this->db->where(['t_laporan.stat_laporan' => 'LS']);
        $this->db->group_by('t_laporan.periode_laporan');

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select($this->select);
        $this->db->from($this->table1);
        $this->db->join($this->table2, $this->index);
        $this->db->where(['t_laporan.stat_laporan' => 'LS']);
        $this->db->group_by('t_laporan.periode_laporan');

        return $this->db->count_all_results();
    }


    function get_periode()
    {
        $query = $this->db->query("select DATE_FORMAT(tanggal,'%Y') as periode FROM t_absen WHERE stat = 'M' AND stat_nilai = 'SN' GROUP BY YEAR(tanggal) ASC");
        $this->db->distinct();
        return $query;
    }
}
