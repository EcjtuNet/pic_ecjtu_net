<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Imglist extends CI_Controller 
{
	var $data = array();
	function __construct()
	{
		
		parent::__construct();
		//可以在config的autoload中设置$autoload['libraries'] = array('database', 'session', 'xmlrpc');
		//$autoload['helper'] = array('url', 'file');
		//$this->load->helper('url');
		$this->load->model('Options_m');
		$this->load->model('Category_m');
		$this->load->model('Posts_m');
		$this->load->model('List_m');
		$this->data['total']=count($this->List_m->get_list(15,0,'newesr',0,1));
		$this->data['options'] = $this->Options_m->get_options();
		$this->data['category'] = $this->Category_m->get_category();
    	$this->data['perpage'] = 3;
    	$this->data['pic_perpage'] = 2;
    	//var_dump($this->data['posts'] );
    	//exit();
		$i = 0;
		foreach ($this->data['category'] as $rs)//将分类的图片信息组合到数组中,用foreach是为了省去for中的count()操作
		{
			$this->data['category'][$i]['cate_pic'] = $this->Posts_m->get_list_by_type(1,$this->data['category'][$i]['category_id'],0,4);
			$j = 0;
			foreach ($this->data['category'][$i]['cate_pic'] as $rss)//将评论条数组合到数组中
			{
				$this->data['category'][$i]['cate_pic'][$j]['comment_num'] = $this->Posts_m->get_comment_num($this->data['category'][$i]['cate_pic'][$j]['posts_id']);
				$j++;
			}
			$i++;
		}
	}
	
	function index($cate=0,$page=0)
	{
		//$data['picid'] = intval($this->uri->segment(2));
	    //$data['comments_size'] = intval($this->uri->segment(3));
		//$pic_offset = isset($_GET['per_page'])&&$_GET['per_page']!=''?$this->input->get('per_page',true):0;
		//$pic_cate = isset($_GET['cate'])&&$_GET['cate']!=''?$this->input->get('cate',true):0;
		foreach($this->data['category']  as $k=>$val )
		{
			$data['cate'][$k]['id']=$val['category_id'];
			$data['cate'][$k]['name']=$val['category_name'];
		}
		if($cate!=0)
		{
			$this->data['total']=count($this->List_m->get_list(15,$cate,'newesr',0,0));
		}
		$pic_offset=$page;
		$pic_cate=$cate;
		//print_r($this->data['options']);
		/*$data['keywords']=$this->data['options']['1']['options_value'];
		$data['description']=$this->data['options']['2']['options_value'];
		$this->load->view('list',$data);*/
		//echo $pic_offset ,$pic_cate;
		$data['newestpic']=$this->List_m->get_list(15,$pic_cate,'newest',$pic_offset);
		
		$this->load->library('pagination');
      	$config['base_url'] = base_url()."index.php/list/$pic_cate/";
	    $config['total_rows'] = $this->data['total'];
		//echo $this->data['total'];
	    $config['per_page'] = 15;
	    //$config['uri_segment'] = 2;
	    //$config['num_links'] = 2;
	    //$config['first_link'] = '第一页';
		$config['full_tag_open'] = '<ul id="pageNum">';
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open'] = '<li>';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
	    $config['next_link'] = '<img src="'.base_url().'images/right.gif" />';
		$config['next_tag_open'] = '<div id="rightPage">';
		$config['next_tag_close'] = '</div>';
	    $config['prev_link'] = '<img src="'.base_url().'images/left.gif" />';
		$config['prev_tag_open'] = '<div id="leftPage">';
		$config['prev_tag_close'] = '</div>';
	    //$config['last_link'] = '最后一页';
	    //$config['page_query_string'] = TRUE;//get分页的关键
	    $this->pagination->initialize($config);
	    $data['page_links']=$this->pagination->create_links();
		//print_r($this->data['category']);
		//echo count($data['newestpic']);
		$this->load->view('list',$data);
	}

}

?>