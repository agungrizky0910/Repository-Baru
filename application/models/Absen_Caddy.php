<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_Caddy extends CI_Model
{
    var $select = array('tanggal', 'jam_masuk', 'stat', 'id_absen');
    var $table1 = 't_absen';
    var $column_order = array('tanggal', 'jam_masuk', 'stat', null); //set column field database for datatable orderable
    var $column_search = array('tanggal', 'jam_masuk', 'stat'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('tanggal' => 'asc'); // default order 


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($fp, $tanggal)
    {

        $this->db->select($this->select);
        $this->db->from($this->table1);
        $this->db->where(['id_fingerprint' => $fp]);
        $this->db->like('tanggal', $tanggal, 'both');

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

    function get_datatables($fp, $tanggal)
    {
        $this->_get_datatables_query($fp, $tanggal);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($fp, $tanggal)
    {
        $this->_get_datatables_query($fp, $tanggal);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($fp, $tanggal)
    {
        $this->db->select($this->select);
        $this->db->from($this->table1);
        $this->db->where(['id_fingerprint' => $fp]);
        $this->db->like('tanggal', $tanggal, 'both');
        return $this->db->count_all_results();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_absen', $id);
        $this->db->delete($this->table1);
    }

    function get_periode($fp)
    {
        $query = $this->db->query("select DATE_FORMAT(tanggal,'%Y') as periode FROM t_absen WHERE id_fingerprint='$fp' GROUP BY YEAR(tanggal) ASC");
        $this->db->distinct();
        return $query;
    }
}
