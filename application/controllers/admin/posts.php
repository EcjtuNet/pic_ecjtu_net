<?php
	class Posts extends CI_Controller 
	{
		private $data;
		public function __construct()
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
		
		public function index()
		{
		    $this->load->library('pagination');
		    $config['base_url'] = site_url('admin/posts/index');
		    $config['total_rows'] = $this->Posts_m->get_row_nums();
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
		    $data['post_list'] = $this->Posts_m->get_list($this->uri->segment(4,0),$config['per_page']);
		    $data['category'] = $this->data['category'];
		    $data['wait_check_num'] = $this->Posts_m->wait_check_num();
		    //var_dump( $data['category']);exit();
   			$this->load->view('admin/posts',$data);
		}
		
		function search()
		{
			$keywords = $this->input->get('keywords',true);
			$cid = $this->input->get('category',true);
			$this->load->library('pagination');
		    $config['base_url'] = site_url("admin/posts/search?keywords=$keywords&category=$cid");
		    $config['per_page'] = '15';
		    $config['total_rows'] = $this->Posts_m->search($this->input->get('per_page'),$config['per_page'],$keywords,$cid,true);
		    $config['page_query_string'] = TRUE;
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
		    $data['post_list'] = $this->Posts_m->search($this->input->get('per_page'),$config['per_page'],$keywords,$cid);
		    $data['category'] = $this->data['category'];
		    $data['wait_check_num'] = $this->Posts_m->wait_check_num();
		    //var_dump( $data['category']);exit();
   			$this->load->view('admin/posts',$data);
		}
		
		function post_cate($cid)
		{
			$this->load->library('pagination');
		    $config['base_url'] = site_url('admin/posts/post_cate/'.$cid);
		    $config['total_rows'] = $this->Posts_m->get_row_nums($cid);
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
		    $data['post_list'] = $this->Posts_m->get_list($this->uri->segment(5,0),$config['per_page'],$cid,false);
		    $data['category'] = $this->data['category'];
		    $data['wait_check_num'] = $this->Posts_m->wait_check_num();
		    $this->load->view('admin/posts_cate',$data);
		}
		
		function post_check($pid=0)
		{
			$this->load->library('pagination');
			if($pid!=0)
			{
				$this->Posts_m->check_ok($pid);
				$config['base_url'] = site_url('admin/posts/post_check/'.$pid);
				$config['uri_segment'] = 5;
				$config['per_page'] = '15';
				$data['post_list'] = $this->Posts_m->get_list($this->uri->segment(5,0),$config['per_page'],false,true);
			}
			else {
				$config['base_url'] = site_url('admin/posts/post_check');
				$config['uri_segment'] = 4;
				$config['per_page'] = '15';
				$data['post_list'] = $this->Posts_m->get_list($this->uri->segment(4,0),$config['per_page'],false,true);
			}
		    $config['total_rows'] = $this->Posts_m->get_row_nums('',true);
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
		    $data['category'] = $this->data['category'];
		    $this->load->view('admin/posts_check',$data);
		}
		
		function view($pid)
		{
		    $data['options'] = $this->data['options'];
			$data['website'] = $this->data['options']['0']['options_value'];
			$data['copyright'] = $this->data['options']['3']['options_value'];
		    $data['post_list'] = $this->Posts_m->get_post_by_id($pid);
		    $data['category'] = $this->data['category'];
			$data['detail']=is_null($data['post_list'][0]['posts_detail'])?array_fill(0,$data['post_list'][0]['posts_count'],''):unserialize($data['post_list'][0]['posts_detail']);
			//var_dump($data['detail']);
		    $this->load->view('admin/post_view',$data);
		}
		
		function mod()
		{
		    $thumbtype = isset($_POST['type'])?$_POST['type']:0;
		    $id = isset($_POST['id'])?intval($_POST['id']):0;
		    $pictures = isset($_POST['pictures'])?$_POST['pictures']:array();
		    $post_category = isset($_POST['category'])?$_POST['category']:0;
		    $thumbfile = '';
		    $detail_descriptions = isset($_POST['descp'])?$_POST['descp']:array();//每张图片的评论;
		    if(isset($_POST['select_thumb'])&&!empty($pictures))
		    {
		    	$k = $_POST['select_thumb']-1;
		    	if($k>=0&&$k<=count($pictures))
		    	{
		    		$thumbfile = $pictures[$k];
		    	}
		    	else 
		    	{
		    		$thumbfile = $pictures['0'];
		    	}
		    }
		    $data = array(
	            'posts_title'=>isset($_POST['title'])?$_POST['title']:'',
	            'posts_slug'=>isset($_POST['slug'])?$_POST['slug']:'',
	            'posts_category'=>$post_category,
	            'posts_type'=>$thumbtype,
	            'posts_author' => isset($_POST['author'])?$_POST['author']:'日新网友',
	            'posts_keywords' => isset($_POST['title'])?$_POST['title']:'',
	            'posts_description'=>isset($_POST['description'])?$_POST['description']:'',
	            'posts_thumb'=>$thumbfile,
	            'posts_pubdate'=>isset($_POST['date'])?strtotime($_POST['date']):time(),
	            'posts_hit'=>isset($_POST['hit'])?intval($_POST['hit']):'',
	            'posts_pictures'=>serialize($pictures),
	            'posts_count'=>isset($_POST['pictures'])?count($_POST['pictures']):0,
		    'posts_detail'=>serialize($detail_descriptions)
		    );
		    if($id>0) {
		      if($this->Posts_m->post_update($id,$data)) {
		      	echo '<script>
					location = "'.site_url('admin/posts').'";'
				.'</script>';
				exit();
		      	/*
		        $this->data['msgtitle']='修改成功';
		        $this->data['msgcontent']='恭喜你，图集修改成功！';
		        $this->data['gotourl']="window.location.href='".site_url('admin/posts')."'";
		        $this->load->view('admin/message',$this->data);
		        */
		      }else {
		       echo '<script>
					alert("修改失败");
					location = "'.site_url('admin/posts').'";'
				.'</script>';
				exit();
		      }
		    }
		}
		
		function post_add()
		{
			$data['options'] = $this->data['options'];
			$data['website'] = $this->data['options']['0']['options_value'];
			$data['copyright'] = $this->data['options']['3']['options_value'];
			$data['category'] = $this->data['category'];
			$this->load->view('admin/post_add',$data);
		}
		
		function add()
		{
			$thumbtype = isset($_POST['type'])?$_POST['type']:0;
		    $pictures = isset($_POST['pictures'])?$_POST['pictures']:array();
		    $post_category = isset($_POST['category'])?$_POST['category']:0;
		    $thumbfile = '';
		    $detail_descriptions = isset($_POST['descp'])?$_POST['descp']:array();//每张图片的评论;
		    if(isset($_POST['select_thumb'])&&!empty($pictures))
		    {
		    	$k = $_POST['select_thumb']-1;
		    	if($k>=0&&$k<=count($pictures))
		    	{
		    		$thumbfile = $pictures[$k];
		    	}
		    	else 
		    	{
		    		$thumbfile = $pictures['0'];
		    	}
		    }
		    $data = array(
	            'posts_title'=>isset($_POST['title'])?$_POST['title']:'',
	            'posts_slug'=>isset($_POST['slug'])?$_POST['slug']:'',
	            'posts_category'=>$post_category,
	            'posts_type'=>$thumbtype,
	            'posts_keywords' => isset($_POST['title'])?$_POST['title']:'',
	            'posts_description'=>isset($_POST['description'])?$_POST['description']:'',
	            'posts_author' => isset($_POST['author'])?$_POST['author']:'admin',
	            'posts_thumb'=>$thumbfile,
	            'posts_check'=>1,
	            'posts_pubdate'=>time(),
	            'posts_hit'=>isset($_POST['hit'])?intval($_POST['hit']):'',
	            'posts_pictures'=>serialize($pictures),
	            'posts_count'=>isset($_POST['pictures'])?count($_POST['pictures']):0,
		    'posts_detail'=>serialize($detail_descriptions)
		    );
	      if($this->Posts_m->post_insert($data)) {
	      	echo '<script>
				alert("添加成功~");
				location = "'.site_url('admin/posts').'";'
			.'</script>';
			exit();
	      }else {
	       echo '<script>
				alert("添加失败");
				location = "'.site_url('admin/posts').'";'
			.'</script>';
			exit();
	      }
		}
	
		function del($pid)
		{
			if($this->Posts_m->post_del($pid)) {
		      	echo '<script>
					location = "'.site_url('admin/posts').'";'
				.'</script>';
				exit();
		    }else {
		       echo '<script>
					alert("删除失败");
					location = "'.site_url('admin/posts').'";'
				.'</script>';
				exit();
		      }
			}
	}
?>
