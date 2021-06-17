<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apps extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function insert($table = '', $data = '')
	{
		return $this->db->insert($table, $data);
	}

	function get_all($table)
	{
		$this->db->from($table);

		return $this->db->get();
	}

	function get_select($select, $table)
	{
		$this->db->select($select);
		$this->db->from($table);

		return $this->db->get();
	}

	function get_select_where($select, $table, $where)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get();
	}


	function get_select_where_group_order($select, $table, $where, $group, $byname, $order)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->group_by($group);
		$this->db->order_by($byname, $order);

		return $this->db->get();
	}

	function get_where($table = null, $where = null)
	{
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get();
	}

	function get_order($table, $byname, $order)
	{
		$this->db->from($table);
		$this->db->order_by($byname, $order);

		return $this->db->get();
	}

	function get_where_order($table, $where, $byname, $order)
	{
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($byname, $order);

		return $this->db->get();
	}

	function get_where_group($table, $where, $group, $byname, $order)
	{
		$this->db->from($table);
		$this->db->where($where);
		$this->db->group_by($group);
		$this->db->order_by($byname, $order);

		return $this->db->get();
	}


	function get_limit($table = null, $byname = null, $urut = null, $limit = null)
	{

		$this->db->from($table);
		$this->db->order_by("$byname", "$urut");
		$this->db->limit($limit);

		return $this->db->get();
	}

	function get_where_limit($table = null, $where = null, $limit)
	{
		$this->db->from($table);
		$this->db->where($where);
		$this->db->limit($limit);

		return $this->db->get();
	}

	function get_where_limit_order($table = null, $where, $byname = null, $urut = null, $limit = null)
	{

		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by("$byname", "$urut");
		$this->db->limit($limit);

		return $this->db->get();
	}

	function get_sebagian($table = null, $order = null)
	{
		$this->db->from($table);
		$this->db->order($order);

		return $this->db->get();
	}

	function update($table = null, $data = null, $where = null)
	{
		return $this->db->update($table, $data, $where);
	}

	function delete($table = null, $where = null)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	function delete_like($table = null, $field = null, $match = null)
	{
		$this->db->like($field, $match, 'both');
		$this->db->delete($table);
	}

	function get_urut($table = null, $byname = null, $urut = null)
	{
		$this->db->from($table);
		$this->db->order_by("$byname", "$urut");

		return $this->db->get();
	}

	function get_like($table, $field, $match)
	{
		$this->db->from($table);
		$this->db->like($field, $match, 'both');
		return $this->db->get();
	}

	function select_get_like($select, $table, $field, $match)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->like($field, $match, 'both');
		return $this->db->get();
	}

	function select_get_like_where($select, $table, $where, $field, $match)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->like($field, $match, 'both');
		return $this->db->get();
	}

	function select_get_join_like_where($select, $table, $table2, $index, $where, $field, $match)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->where($where);
		$this->db->like($field, $match, 'both');
		$this->db->distinct();
		return $this->db->get();
	}

	function get_like_order($table, $field, $match, $byname, $urut)
	{
		$this->db->from($table);
		$this->db->like($field, $match, 'both');
		$this->db->order_by("$byname", "$urut");
	}

	function get_like_limit($table, $match, $limit, $start)
	{

		$this->db->from($table);
		$this->db->like($match);
		$this->db->limit($limit, $start);
	}

	function select_join_where($select, $where, $table1, $table2, $index)
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $index);
		$this->db->where($where);

		return $this->db->get();
	}

	function select_join_3_where($select, $where, $table1, $table2, $index, $table3, $index2)
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $index);
		$this->db->join($table3, $index2);
		$this->db->where($where);

		return $this->db->get();
	}

	function select_join_where_order($select, $where, $table1, $table2, $index, $byname, $order)
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $index);
		$this->db->where($where);
		$this->db->order_by("$byname", "$order");

		return $this->db->get();
	}


	function select_join_where_order_uniq($select, $where, $table1, $table2, $index, $byname, $order)
	{
		$this->db->distinct();
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $index);
		$this->db->where($where);
		$this->db->order_by("$byname", "$order");

		return $this->db->get();
	}

	function select_join_where_order_limit($select, $where, $table1, $table2, $index, $byname, $order, $limit)
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $index);
		$this->db->where($where);
		$this->db->order_by("$byname", "$order");
		$this->db->limit($limit);

		return $this->db->get();
	}

	function select_join_3_where_order_limit($select, $where, $table1, $table2, $table3, $index, $index2, $byname, $order, $limit)
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $index);
		$this->db->join($table3, $index2);
		$this->db->where($where);
		$this->db->order_by("$byname", "$order");
		$this->db->limit($limit);

		return $this->db->get();
	}

	function render_data($table, $where, $order, $by, $limit, $start)
	{
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function render_data_search($table, $where, $match, $field1, $field2, $order, $by, $limit, $start)
	{
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where($where);
		$this->db->like($field1, $match, 'both');
		$this->db->or_like($field2, $match, 'both');
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function render_join_data($table, $table2, $index, $where, $order, $by, $limit, $start)
	{
		$this->db->select("*");
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->where($where);
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function render_join_data_search($table, $table2, $index, $where, $match, $field1, $field2, $order, $by, $limit, $start)
	{
		$this->db->select("*");
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->where($where);
		$this->db->like($field1, $match, 'both');
		$this->db->or_like($field2, $match, 'both');
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function render_select_join_data($select, $table, $table2, $index, $where, $order, $by, $limit, $start)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->where($where);
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function render_select_join_data_search($select, $table, $table2, $index, $where, $match, $field1, $field2, $order, $by, $limit, $start)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->where($where);
		$this->db->like($field1, $match, 'both');
		$this->db->or_like($field2, $match, 'both');
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function render_join_3_data($table, $table2, $index, $table3, $index2, $where, $order, $by, $limit, $start)
	{
		$this->db->select("*");
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->join($table3, $index2);
		$this->db->where($where);
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function render_join_3_data_seach($table, $table2, $index, $table3, $index2, $where, $match, $field1, $field2, $order, $by, $limit, $start)
	{
		$this->db->select("*");
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->join($table3, $index2);
		$this->db->where($where);
		$this->db->like($field1, $match, 'both');
		$this->db->or_like($field2, $match, 'both');
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function render_select_join_3_data($select, $table, $table2, $index, $table3, $index2, $where, $order, $by, $limit, $start)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->join($table3, $index2);
		$this->db->where($where);
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function render_select_join_3_data_search($select, $table, $table2, $index, $table3, $index2, $where, $match, $field1, $field2, $order, $by, $limit, $start)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->join($table3, $index2);
		$this->db->where($where);
		$this->db->like($field1, $match, 'both');
		$this->db->or_like($field2, $match, 'both');
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}


	function select_join_4_where($select, $table, $table2, $index, $table3, $index2, $table4, $index3, $where, $order, $by)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->join($table3, $index2);
		$this->db->join($table4, $index3);
		$this->db->where($where);
		$this->db->order_by("$order", "$by");
		$query = $this->db->get();
		return $query;
	}

	function render_select_join_4_data($select, $table, $table2, $index, $table3, $index2, $table4, $index3, $where, $order, $by, $limit, $start)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->join($table3, $index2);
		$this->db->join($table4, $index3);
		$this->db->where($where);
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function render_select_join_4_data_search($select, $table, $table2, $index, $table3, $index2, $table4, $index3, $where, $match, $field1, $field2, $order, $by, $limit, $start)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->join($table3, $index2);
		$this->db->join($table4, $index3);
		$this->db->where($where);
		$this->db->like($field1, $match, 'both');
		$this->db->or_like($field2, $match, 'both');
		$this->db->order_by("$order", "$by");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}

	function join_where_order($table, $table2, $index, $where, $order, $by)
	{
		$this->db->select("*");
		$this->db->from($table);
		$this->db->join($table2, $index);
		$this->db->where($where);
		$this->db->order_by("$order", "$by");
		$query = $this->db->get();
		return $query;
	}

	function insert_last($table = '', $data = '')
	{
		$this->db->insert($table, $data);

		return $this->db->insert_id();
	}

	function cek_user($username)
	{
		$query = $this->db->query("SELECT * FROM t_user WHERE BINARY username = '$username'");
		return $query;
	}

	function cek_code($code)
	{
		$query = $this->db->query("SELECT * FROM t_user WHERE BINARY reset_key = '$code'");
		return $query;
	}

	function data_kinerja($field, $match)
	{
		$this->db->select('COALESCE(SUM(total_skor),0) as total');
		$this->db->from('t_laporan');
		$this->db->where([$field => $match]);

		return $this->db->get();
	}
}
