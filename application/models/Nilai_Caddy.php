<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_Caddy extends CI_Model
{
    var $select = array('DATE_FORMAT(t_absen.tanggal,"%Y-%m") as periode', 't_caddy.foto', 't_caddy.nama', 't_caddy.nip', 't_caddy.id_fingerprint');
    var $table1 = 't_absen';
    var $table2 = 't_caddy';
    var $index = 't_absen.id_fingerprint = t_caddy.id_fingerprint';
    var $column_order = array(null, 't_caddy.nama', 't_caddy.nip', null, null); //set column field database for datatable orderable
    var $column_search = array(null, 't_caddy.nama', 't_caddy.nip', null, null); //set column field database for datatable searchable just firstname , lastname , address are searchable
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
        $this->db->where(['t_absen.stat' => 'M', 't_absen.stat_nilai' => 'BN', 't_caddy.hapus' => '0']);
        $this->db->like('t_absen.tanggal', $tgl, 'both');
        $this->db->group_by('nip');

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
        $this->db->where(['t_absen.stat' => 'M', 't_absen.stat_nilai' => 'BN', 't_caddy.hapus' => '0']);
        $this->db->like('t_absen.tanggal', $tgl, 'both');
        $this->db->group_by('nip');
        return $this->db->count_all_results();
    }


    function get_periode()
    {
        $query = $this->db->query("select DATE_FORMAT(tanggal,'%Y') as periode FROM t_absen WHERE stat = 'M' AND stat_nilai = 'BN' GROUP BY YEAR(tanggal) ASC");
        $this->db->distinct();
        return $query;
    }
}
