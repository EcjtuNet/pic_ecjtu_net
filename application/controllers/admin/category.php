<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller 
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
		$this->load->model('Category_m');
		$this->data['options'] = $this->Options_m->get_options();
		$this->data['category'] = $this->Category_m->get_category();
	}
	
	function index()
	{
		$data['website'] = $this->data['options']['0']['options_value'];
		$data['copyright'] = $this->data['options']['3']['options_value'];
		$data['category'] = $this->data['category'];
		$this->load->view('admin/category',$data);
	}
	
	function category_add()
	{
		$data['website'] = $this->data['options']['0']['options_value'];
		$data['copyright'] = $this->data['options']['3']['options_value'];
		$data['category'] = $this->data['category'];
		$this->load->view('admin/category_add',$data);
	}
	
	function cate_add()
	{
		$this->load->model('category_m');
		$data = array(
			'category_slug' => $this->input->post('category_slug',true),
			'category_name' => $this->input->post('category_name',true),
			'category_keywords' => $this->input->post('category_keywords',true),
			'category_description' => $this->input->post('category_description',true),
		);
		$bool = $this->category_m->category_insert($data);
		if($bool==true)
		{
			echo "<script language='javascript'>"; 
			echo "alert('添加成功~');";
			echo " location = './';";
			echo "</script>";
		}
		else
		{
			echo "<script language='javascript'>"; 
			echo "alert('添加失败...');";
			echo " location = './';";
			echo "</script>";
		}
	}
	
	function cate_change()
	{
		$this->load->model('category_m');
		$data = array(
			'category_id'   => $this->input->post('category_id',true),
			'category_slug' => $this->input->post('category_slug',true),
			'category_name' => $this->input->post('category_name',true),
			'category_keywords' => $this->input->post('category_keywords',true),
			'category_description' => $this->input->post('category_description',true),
		);
		$bool = $this->category_m->category_update($data);
		if($bool==true)
		{
			echo "<script language='javascript'>"; 
			echo "alert('修改成功~');";
			echo " location = './';";
			echo "</script>";
		}
		else
		{
			echo "<script language='javascript'>"; 
			echo "alert('修改失败...');";
			echo " location = './';";
			echo "</script>";
		}
	}
	
	function change($slug)
	{
		//$slug = $this->uri->segment('4');
		$this->load->model('category_m');
		$cate_info = $this->category_m->get_category_by_slug($slug);
		$data['website'] = $this->data['options']['0']['options_value'];
		$data['copyright'] = $this->data['options']['3']['options_value'];
		$data['cate_info'] = $cate_info;
		$this->load->view('admin/category_change',$data);
	}
}
?>