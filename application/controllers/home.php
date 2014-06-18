<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller 
{
	private $data = array();
	function __construct()
	{
		parent::__construct();
		//可以在config的autoload中设置$autoload['libraries'] = array('database', 'session', 'xmlrpc');
		//$autoload['helper'] = array('url', 'file');
		//$this->load->helper('url');
		$this->load->model('Options_m');
		$this->load->model('Category_m');
		$this->load->model('Posts_m');
		$this->data['options'] = $this->Options_m->get_options();
		$cache = unserialize($this->data['options']['4']['options_value']);
		if($cache['cache_enabled'])
		{
			//echo $cache['cache_expire_time'];exit();
			$this->output->cache($cache['cache_expire_time']);
		}
		$this->data['category'] = $this->Category_m->get_category();
		$i = 0;
		foreach ($this->data['category'] as $rs)//将分类的图片信息组合到数组中,用foreach是为了省去for中的count()操作
		{
			$this->data['category'][$i]['cate_pic'] = $this->Posts_m->get_list_by_type(1,$this->data['category'][$i]['category_id'],0,9);
			$j = 0;
			foreach ($this->data['category'][$i]['cate_pic'] as $rss)//将评论条数组合到数组中
			{
				$this->data['category'][$i]['cate_pic'][$j]['comment_num'] = $this->Posts_m->get_comment_num($this->data['category'][$i]['cate_pic'][$j]['posts_id']);
				$j++;
			}
			$i++;
		}
	}
	public function index()
	{
		$data['webtitle'] = $this->data['options']['0']['options_value'];
		$data['keywords'] = $this->data['options']['1']['options_value'];
		$data['description'] = $this->data['options']['2']['options_value'];
		$data['copyright'] = $this->data['options']['3']['options_value'];
		$data['category'] = $this->data['category'];
		$data['focuspic'] = $this->Posts_m->get_list_by_type(2,0,0,3);
		foreach($data['focuspic'] as $k=>$v)
		{
			$data['cateid'][$k]=$v['posts_category'];
			$pics[$k] = unserialize($v['posts_pictures']);
		}
		$data['pictures']=$pics;
		//print_r($pics);
		$data['hotpic'] = $this->Posts_m->get_hot_newest(10,0,'hot');
		$data['newestpic'] = $this->Posts_m->get_hot_newest(10,0,'newest');
		$data['cateid']=0;
		//var_dump($data['category']);
		//exit();
		//print_r($data['newestpic']);
		$this->load->view('index',$data);
	}
}
?>
