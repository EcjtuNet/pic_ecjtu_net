<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Options extends CI_Controller 
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
			$this->load->model('Options_m');
			$this->data['options'] = $this->Options_m->get_options();
		}
		
		function index()
		{
			$data['options'] = $this->data['options'];
			$data['website'] = $this->data['options']['0']['options_value'];
			$data['copyright'] = $this->data['options']['3']['options_value'];
			$this->load->view('admin/options',$data);
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