<?php

class Excel_import_model extends CI_Model
{

    function select($select, $where, $table1, $table2, $index)
    {
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2, $index);
        $this->db->where($where);
        $this->db->order_by('tanggal', 'ASC');

        return $this->db->get();
    }

    function insert($data)
    {

        $this->db->insert_batch('t_absen', $data);
    }
}
