<?php
class m_test extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function insertMssage($admin_name,$admin_content){
		$query = $this->db->query("INSERT INTO admin_message(id,message_name,message_content,message_date)VALUE('','$admin_name','$admin_content',now())");
		return $this->db->affected_rows();
	}
	public function select_num_rows(){
		$query=$this->db->query("SELECT * FROM admin_message");
		return $query->num_rows();
	}
	public function get_page($offset,$num){
		$query=$this->db->query("SELECT * FROM admin_message order by id desc limit $offset,$num");
		return $query->result();
	}
}