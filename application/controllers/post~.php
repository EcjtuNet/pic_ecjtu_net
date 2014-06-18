<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Post extends CI_Controller 
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
		$this->data['options'] = $this->Options_m->get_options();
		$this->data['category'] = $this->Category_m->get_category();
    	$this->data['perpage'] = 2;
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
	
	function index()
	{
		Header("Location:".site_url());
    	exit();
	}
	
	function view()
	{
		$data['picid'] = intval($this->uri->segment(2));
	    $data['comments_size'] = intval($this->uri->segment(3));
    	if($data['picid']!='' && $data['picid']>0)
    	{
	    	$data['posts'] = $this->Posts_m->get_post_by_id($data['picid']);
    		$this->Posts_m->update_hits($data['picid']);
    		$data['cateid'] = $data['posts']['0']['posts_category'];
    		$data['pictures'] = unserialize($data['posts']['0']['posts_pictures']);
    		//var_dump($this->data['posts']);
    		$data['webtitle'] = $data['posts']['0']['posts_title'];
			$data['keywords'] = $data['posts']['0']['posts_keywords'];
			$data['description'] = $data['posts']['0']['posts_description'];
			$data['copyright'] = $this->data['options']['3']['options_value'];
			$data['category'] = $this->data['category'];
			$data['hotpic'] = $this->Posts_m->get_hot_newest(10,0,'hot');
			$data['newestpic'] = $this->Posts_m->get_hot_newest(10,0,'newest');
			$data['comments_num'] = $this->Posts_m->get_comments_nums($data['posts']['0']['posts_id']);
			$data['comments_size'] = $data['comments_size']>($data['comments_num']-1)?($data['comments_num']-1):$data['comments_size'];//如果超过了限制就用最大的
			$data['comments'] = $this->Posts_m->get_comments_by_id($data['posts']['0']['posts_id'],$data['comments_size'],$this->data['perpage']);	 		
			$data['perpage'] = $this->data['perpage'];
			/*
			$this->load->library('pagination');
      		$config['base_url'] = site_url('/comments?cateid='.$data['picid']);
	        $config['total_rows'] = $data['comments_num'];
	        $config['per_page'] = $this->data['perpage'];
	        $config['uri_segment'] = 3;
	        $config['num_links'] = 10;
	        $config['first_link'] = '第一页';
	        $config['next_link'] = '下一页';
	        $config['prev_link'] = '上一页';
	        $config['last_link'] = '最后一页';
	        $config['page_query_string'] = TRUE;//get分页的关键
	        $this->pagination->initialize($config);
	        $data['page_links']=$this->pagination->create_links();
	        */
			$this->load->view('post',$data);
    	}
    	else
    	{
    		Header("Location:".site_url());
    		exit();
    	}
	}
	
	function comments_insert()
	{
		$comments = array(
			'comments_posts_id' => $this->input->post('comments_posts_id', TRUE)!=''?$this->input->post('comments_posts_id', TRUE):'',
			'comments_time'		=> time(),
			'comments_author'	=> $this->input->post('author', TRUE)!=''?$this->input->post('author', TRUE):'',
			'comments_text'		=> $this->input->post('text', TRUE)!=''?$this->input->post('text', TRUE):'',
			'comments_ip'		=> $this->input->ip_address(),
		);
		$comments_bool = $this->Posts_m->comments_insert($comments);
		if($comments_bool)
		{
			Header("Location:".site_url('pictures').'/'.$this->input->post('comments_posts_id', TRUE));
			exit();
		}
		else
		{
			echo '<script>
					alert("comments error!");
				</script>';
				Header("Location:".site_url('pictures').'/'.$this->input->post('comments_posts_id', TRUE));
				exit();
		}
		/*
		if(is_array($comments_temp) && count($comments_temp) > 0)
		{
			$comments_num = $this->Posts_m->get_comments_nums($comments['comments_posts_id']);
			$this->load->library('pagination');
      		$config['base_url'] = site_url('comments');
	        $config['total_rows'] =$comments_num;
	        $config['per_page'] = $this->data['perpage'];
	        $config['uri_segment'] = 3;
	        $config['num_links'] = 10;
	        $config['first_link'] = '第一页';
	        $config['next_link'] = '下一页';
	        $config['prev_link'] = '上一页';
	        $config['last_link'] = '最后一页';
	        $this->pagination->initialize($config);
	        $page_links = $this->pagination->create_links();
			isset($comments_num)?$comments_num:$comments_num = '0';
			$comments_list .= '<div id="pic_comments">
		  		<h3>'.  $comments_num.'条评论 <a href="#pic_comments">»</a></h3>';
			 foreach ($comments_temp as $rs)
			 {
		  		$comments_list .='
		  		<div class="comment-info">
					<b>'.$rs['comments_author'].'</b><p style="text-align:right; color:#F33; float:right"></p><br />
	                <span class="comment-time">'. date('F j, Y, g:i a',$rs['comments_time']).'</span><br />
	                <span class="comment-time">IP:'. $rs['comments_ip'].'</span>
					<div class="comment-content">'.$rs['comments_text'].'</div>
				</div>';
			}
			$comments_list .= 
			'</div>
     		<div id="pages">'. $page_links .'</div>';
			echo $comments_list;
			
		}
		else
		{
			echo $comments_temp;
		}
		*/
	}
	
	function comments_ajax()
	{
		$comments_list = '';
		$pageIndex = intval($this->input->post('pageIndex', TRUE));
	    $cateid = intval($this->input->post('cateid', TRUE));
	    $comments_temp = $this->Posts_m->get_comments_by_id($cateid,$pageIndex,$this->data['perpage']);
	    foreach ($comments_temp as $rs)
			 {
		  		$comments_list .='
		  		<div class="comment-info">
					<b>'.$rs['comments_author'].'</b><p style="text-align:right; color:#F33; float:right"></p><br />
	                <span class="comment-time">'. date('F j, Y, g:i a',$rs['comments_time']).'</span><br />
	                <span class="comment-time">IP:'. $rs['comments_ip'].'</span>
					<div class="comment-content">'.$rs['comments_text'].'</div>
				</div>';
			}
		echo $comments_list;
	    exit();
	}
	
	function thumb()
	{
		$pic = str_replace('_', '/', $this->uri->segment(2));
		$type = $this->uri->segment(3);
		$target_width =  150;
		$target_height = 150;
		if(intval($type))
		{
			switch ($type)
			{
				case 1:
					$target_width = 690;
					$target_height = 500;
					break;
				case 2:
					$target_width = 160;
					$target_height = 160;
				  break;
				case 3:
					$target_width = 150;
					$target_height = 150;
				  break;
				case 4:
					$target_width = 240;
					$target_height = 345;
				  break;
				case 5:
					$target_width = 146;
					$target_height = 117;
				  break;
				default:
				  	$target_width = 150;
					$target_height = 150;
			}
		}
		if( ! file_exists($pic) ) {
	      exit(0);
	    }
	    $this->_create_thumb($pic,$target_width,$target_height);
	}
	function _create_thumb($uploadfile,$target_width,$target_height) {

    $img = imagecreatefromjpeg($uploadfile);
    $width = imageSX($img);
    $height = imageSY($img);

    $target_ratio = $target_width / $target_height;
    $img_ratio = $width / $height;

    if ($target_ratio < $img_ratio) {
      $new_height = $target_height;
      $new_width = $img_ratio * $target_height;
    } else {
      $new_height = $target_width / $img_ratio;
      $new_width = $target_width;
    }
    if ($new_height < $target_height) {
      $new_height = $target_height;
    }
    if ($new_width < $target_width) {
      $new_height = $target_width;
    }

    $this->load->library('image_lib');

    $config['image_library'] = 'gd2';
    $config['source_image'] = $uploadfile;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $thumbfile = '';
    $config['new_image'] = $thumbfile;
    $config['thumb_marker'] = '';
    $config['width'] = $new_width;
    $config['height'] = $new_height;

    $this->image_lib->initialize($config);
    $this->image_lib->resize();
    
	$config['source_image']=$thumbfile;
    $config['maintain_ratio']=FALSE;
    $config['dynamic_output'] = TRUE;
    $config['width'] = $target_width;
    $config['height'] = $target_height;
    $config['x_axis'] = ($new_width-$target_width)/2 ;
    $config['y_axis'] = ($new_height-$target_height)/6;
    $this->image_lib->initialize($config);
    $this->image_lib->crop();
  }
}
?>