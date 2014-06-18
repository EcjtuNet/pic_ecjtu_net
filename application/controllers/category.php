<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller 
{
	private $data;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Options_m');
		$this->load->model('Category_m');
		$this->data['options'] = $this->Options_m->get_options();
		$this->data['category'] = $this->Category_m->get_category();
	}
	function index()
	{
		$perpage = 15;
		$cate_slug = $this->uri->segment(1,'');
		$pagesize = intval($this->uri->segment(2));
		$category = $this->Category_m->get_category_by_slug($cate_slug);
		if(count($category)>0)
		{
			$cate_id = $category['0']['category_id'];
			$cate_name = $category['0']['category_name'];
			$data['cateid'] = $cate_id;
			$data['keywords'] = $category['0']['category_keywords'];
			$data['description'] = $category['0']['category_description'];
		}
		else
		{
			Header("Location:".site_url());
      		exit();
		}
		$this->load->model('Posts_m');
		$this->load->library('pagination');
		$config['base_url'] = site_url($cate_slug);
		$config['total_rows'] = $this->Posts_m->get_row_nums($cate_id);
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 4;
		$config['num_links'] = 10;
		$config['first_link'] = '第一页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$config['last_link'] = '最后一页';
		$this->pagination->initialize($config);
		$data['page_links'] = $this->pagination->create_links();
		$data['posts_pic'] = $this->Posts_m->get_list_by_type('',$cate_id,$pagesize,$perpage);
		$data['webtitle'] = $cate_name.'_第'.(($pagesize/$config['per_page'])+1).'页 -- '.$this->data['options']['0']['options_value'];
		$data['category'] = $this->data['category'];
		$data['copyright'] = $this->data['options']['3']['options_value'];
		$i = 0;
		//echo $this->Posts_m->get_comments_nums(22);exit();
		foreach ($data['posts_pic'] as $rs)
		{
			$data['posts_pic'][$i]['comment_num'] = $this->Posts_m->get_comments_nums($data['posts_pic'][$i]['posts_id']);
			//var_dump($this->Posts_m->get_comments_nums($data['posts_pic'][$i]['posts_id']));
			$i++;
		}
		//var_dump($data['posts_pic']);
		//exit();
		$cache = unserialize($this->data['options']['4']['options_value']);
		if($cache['cache_enabled'])
		{
			//echo $cache['cache_expire_time'];exit();
			$this->output->cache($cache['cache_expire_time']);
		}
		$this->load->view('category',$data);
	}
}
?>