<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_Laporan_Selesai extends CI_Model
{
    var $select = 't_caddy.foto, t_caddy.nama, t_laporan.periode_laporan, t_caddy.nip, t_laporan.id_laporan, t_laporan.skor_absen, t_laporan.skor_turun, t_laporan.total_skor';
    var $table1 = 't_caddy';
    var $table2 = 't_laporan';
    var $index = 't_caddy.id_caddy=t_laporan.id_caddy';
    var $column_order = array('tanggal', 'stat_nilai'); //set column field database for datatable orderable
    var $column_search = array('tanggal', 'stat_nilai'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('t_caddy.nama' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($tgl)
    {

        $this->db->select($this->select);
        $this->db->from($this->table1);
        $this->db->join($this->table2, $this->index);
        $this->db->where(['periode_laporan' => $tgl, 'stat_laporan' => 'LS']);

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

    function get_datatables($tgl)
    {
        $this->_get_datatables_query($tgl);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($tgl)
    {
        $this->_get_datatables_query($tgl);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($tgl)
    {
        $this->db->select($this->select);
        $this->db->from($this->table1);
        $this->db->join($this->table2, $this->index);
        $this->db->where(['periode_laporan' => $tgl, 'stat_laporan' => 'LS']);
        return $this->db->count_all_results();
    }


    function get_periode()
    {
        $query = $this->db->query("select DATE_FORMAT(tanggal,'%Y') as periode FROM t_absen WHERE stat = 'M' AND stat_nilai = 'BN' GROUP BY YEAR(tanggal) ASC");
        $this->db->distinct();
        return $query;
    }
}
