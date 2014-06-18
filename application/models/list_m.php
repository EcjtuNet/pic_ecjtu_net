<?php
class List_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_list($total_num=15,$cate=0,$type='newest',$page=0,$en_total=0)//$cate不设置就是选择全局的TOP，也可以指定$cate让一个类中的top
	{	
		//$start=$total_num*($page-1);
		if($en_total==1)
		{
			return $this->db->get('posts')->result_array();
		}
		if($cate > 0)
		{
			$this->db->where('posts_category',$cate);
		}
		switch ($type)
		{
			case 'hot':
				$this->db->order_by('posts_hit','desc');
				break;
			case 'newest':
				$this->db->order_by('posts_pubdate','desc');
				break;
		}
		//$this->db->where('posts_check',1);
		$this->db->join('category','category_id=posts_category','left');//因为要返回该图集的名称
		return $this->db->get('posts',$total_num,$page)->result_array();
	}
}

?>