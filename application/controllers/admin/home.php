<?php
	class Home extends CI_Controller 
	{
		private $data = array();
		function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			if($this->session->userdata('userid')=='')
			{
				 Header("Location:".site_url('admin/login'));
     			 exit();
			}
			$this->load->model('options_m');
			$this->data['options'] = $this->options_m->get_options();		
		}
		
		function index()
		{
			$this->load->model('category_m');
			$this->load->model('posts_m');
			$data['cate_nums'] = $this->category_m->get_category_nums();
			$data['posts_nums'] = $this->posts_m->get_row_nums();
			$data['website'] = $this->data['options']['0']['options_value'];
			$data['copyright'] = $this->data['options']['3']['options_value'];
			$data['recent_post'] = $this->posts_m->get_hot_newest(6,0,'newest');
			$data['recent_comment'] = $this->posts_m->get_comments(0,6);
			$data['wait_check_num'] = $this->posts_m->wait_check_num();
			$data['options'] = $this->data['options'];
			$data['website'] = $this->data['options']['0']['options_value'];
			$data['copyright'] = $this->data['options']['3']['options_value'];
			$this->load->view('admin/index',$data);
		}
	function options_change()
		{
			$this->load->model('options_m');
			$cache = array();
			$cache['cache_enabled'] = $this->input->post('cache_enabled',true);
			$cache['cache_expire_time'] = $this->input->post('cache_expire_time',true);
			$data = array(
				$this->input->post('webtitle',true),
				$this->input->post('keywords',true),
				$this->input->post('description',true),
				$this->input->post('copyright',true),
				serialize($cache)
			);
			$bool = $this->options_m->options_update($data);
			if($bool==true)
			{
				echo "<script language='javascript'>; 
					 location = './'
					</script>";
			}
			else
			{
				echo "<script language='javascript'>; 
					alert('修改失败!')
					 location = './'
					</script>";
			}
		}
		
		function cache_clear()
		{
			$this->load->helper('file');
		
			delete_files(APPPATH . "cache" . DIRECTORY_SEPARATOR, TRUE);
			
			@copy(APPPATH . 'index.html', APPPATH . "cache/" . 'index.html');
			
			echo "<script language='javascript'>; 
				alert('清除缓存成功~')
				 location = './'
				</script>";
			//redirect('admin/options/');
		}
	}
?>