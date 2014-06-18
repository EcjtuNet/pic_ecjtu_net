<?php
class Category_m extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function get_category()
	{
		return $this->db->get('category')->result_array();
	}
	
	public function get_category_by_slug($slug)
	{
		if($slug=='all'){
			return $this->db->get('category')->result_array();
		}else{
		$this->db->where('category_slug',$slug);
		$this->db->order_by("category_id", "desc");
		return $this->db->get('category')->result_array();
		}
	
	}
	
	public function get_category_by_cid($cateid)
	{
		$this->db->where('category_id',$cateid);
		$this->db->order_by("category_id", "desc");
		return $this->db->get('category')->result_array();
	}
	
	public function get_category_nums()
	{
		return $this->db->get('category')->num_rows();
	}
	
	public function category_insert($data)
	{
		$this->db->insert('category', $data); 
		if($this->db->affected_rows()==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function category_update($data)
	{
		$this->db->where('category_id', $data['category_id']);
		$this->db->update('category', $data); 
		if($this->db->affected_rows()==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>