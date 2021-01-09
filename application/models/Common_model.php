<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {
    public function single_where_data($where,$table)
    {
        return $this->db->get_where($table,$where)->row_array();
    }
    
    public function batch_insert($table,$dataArr)
    {
        $this->db->insert($table,$dataArr);
        return $this->db->insert_id();
    }
    
    public function get_num_rows($table,$where)
    {
        $this->db->where($where);
        return $this->db->get($table)->num_rows();
        
    }
    
    public function get_where_select_single($select,$where,$table)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $query=$this->db->get();
        return $query->row_array();
    }
    
    public function update_data($table,$data,$where)
    {
        $this->db->update($table,$data,$where);
    }
    
    public function get_where_select_multiple($select,$where,$table)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $query=$this->db->get();
        return $query->result();
    }
    
    public function get_inner_join($select,$where,$table1,$table2)
    {
        $this->db->select($select);    
        $this->db->from($table1);
        $this->db->join($table2,$table1.'.user_id='.$table2.'.user_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    
    function login($email,$password)
	{
		$this -> db->select(' * ');
		$this -> db->from('admin');
		$this -> db->where('email', $email);
		$this -> db->where('password', $password);
		$this -> db->limit(1);
		$query = $this->db-> get();
		return $query;
	}
	
	public function get_multiple_inner_join($select,$where,$table1,$table2,$table3)
    {
        $this->db->select($select);    
        $this->db->from($table1);
        $this->db->join($table2,$table1.'.product_id='.$table2.'.product_id');
        $this->db->join($table3,$table1.'.user_id='.$table3.'.user_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_inner_join_orderdetails($select,$where,$table1,$table2,$table3)
    {
        $this->db->select($select);    
        $this->db->from($table1);
        $this->db->join($table2,$table1.'.order_id='.$table2.'.order_id');
        $this->db->join($table3,$table3.'.product_id='.$table2.'.product_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_pending_request($select,$where,$table1,$table2)
    {
        $this->db->select($select);    
        $this->db->from($table1);
        $this->db->join($table2,$table1.'.user1='.$table2.'.user_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function order_details($select,$where,$table1,$table2)
    {
        $this->db->select($select);    
        $this->db->from($table1);
        $this->db->join($table2,$table1.'.product_id='.$table2.'.product_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    
}
?>