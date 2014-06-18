<?php
class Options_m extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function get_options()
	{
		return $this->db->get('options')->result_array();
	}
	
	public function options_update(array $data)
	{
		foreach ($data as $key=>$item)
		{
			$temp = array(
				'options_value' => $item,
			);
			++$key;
			$this->db->where('options_id',$key );
			$this->db->update('options', $temp); 
		}
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