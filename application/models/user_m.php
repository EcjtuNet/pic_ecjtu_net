<?php
class User_m extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function check($user,$pass)
	{
		$query = $this->db->get_where('users',array('users_name'=>$user,'users_password'=>md5($pass)));
		return $query->num_rows();
	}
	
}
?>