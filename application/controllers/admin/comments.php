<?php
	class Comments extends CI_Controller 
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
			$this->load->model('Posts_m');
			$this->load->model('Options_m');
			$this->data['options'] = $this->Options_m->get_options();
			$this->load->model('Category_m');
			$this->data['category'] = $this->Category_m->get_category();
		}
		
		function index()
		{
			$this->load->library('pagination');
		    $config['base_url'] = site_url('admin/comments/index');
		    $config['total_rows'] = $this->Posts_m->get_comment_num();
		    $config['per_page'] = '15';
		    $config['uri_segment'] = 4;
		    $config['num_links'] = 10;
		    $config['first_link'] = '第一页';
		    $config['next_link'] = '下一页';
		    $config['prev_link'] = '上一页';
		    $config['last_link'] = '最后一页';
		    $this->pagination->initialize($config);
		    $data['page'] = $this->pagination->create_links();
		    $data['options'] = $this->data['options'];
			$data['website'] = $this->data['options']['0']['options_value'];
			$data['copyright'] = $this->data['options']['3']['options_value'];
		    $data['comments_list'] = $this->Posts_m->get_comments($this->uri->segment(4,0),$config['per_page']);
		    $data['category'] = $this->data['category'];
		    //var_dump( $data['category']);exit();
			$this->load->view('admin/comments',$data);
		}
		
		function comment_cate($cid)
		{
			$this->load->library('pagination');
		    $config['base_url'] = site_url("admin/comments/comment_cate/$cid");
		    $config['total_rows'] = $this->Posts_m->get_comment_num($cid);
		    $config['per_page'] = '15';
		    $config['uri_segment'] = 5;
		    $config['num_links'] = 10;
		    $config['first_link'] = '第一页';
		    $config['next_link'] = '下一页';
		    $config['prev_link'] = '上一页';
		    $config['last_link'] = '最后一页';
		    $this->pagination->initialize($config);
		    $data['page'] = $this->pagination->create_links();
		    $data['options'] = $this->data['options'];
			$data['website'] = $this->data['options']['0']['options_value'];
			$data['copyright'] = $this->data['options']['3']['options_value'];
		    $data['comments_list'] = $this->Posts_m->get_comments($this->uri->segment(5,0),$config['per_page'],$cid);
		    $data['category'] = $this->data['category'];
			$this->load->view('admin/comments',$data);
		}
		
		function del($cid)
		{
			if($this->Posts_m->comments_del($cid)) {
		      	echo '<script>
					location = "'.site_url('admin/comments').'";'
				.'</script>';
				exit();
		    }else {
		       echo '<script>
					alert("删除失败");
					location = "'.site_url('admin/comments').'";'
				.'</script>';
				exit();
		      }
			}
	}
?>