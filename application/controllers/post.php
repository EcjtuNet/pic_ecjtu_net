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
    	$this->data['perpage'] = 3;
    	$this->data['pic_perpage'] = 5;
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
//	    $data['comments_size'] = intval($_GET['true']);
	    $pic_offset = isset($_GET['per_page'])&&$_GET['per_page']!=''?$this->input->get('per_page',true):0;
		
    	if($data['picid']!='' && $data['picid']>0)
    	{
	    	$data['posts'] = $this->Posts_m->get_post_by_id($data['picid']);
			$this->data['pic_perpage']=$data['posts'][0]['posts_count'];
			//print_r($data['posts']);
    		$this->Posts_m->update_hits($data['picid']);
    		$data['cateid'] = $data['posts']['0']['posts_category'];
    		$pics = unserialize($data['posts']['0']['posts_pictures']);
    		$data['pictures'] = array_slice($pics,$pic_offset,$this->data['pic_perpage']);
		$data['detail']=is_null($data['posts'][0]['posts_detail'])?array_fill(0,$data['posts'][0]['posts_count'],''):unserialize($data['posts'][0]['posts_detail']);
			foreach($data['pictures'] as $k=>$v)
			{
				$size[$k]=getimagesize($v);
			}
			$data['size']=$size;
			//print_r($size);
    		//var_dump($data['pictures']);
    		$data['webtitle'] = $data['posts']['0']['posts_title'];
			$data['keywords'] = $data['posts']['0']['posts_keywords'];
			$data['description'] = $data['posts']['0']['posts_description'];
			$data['copyright'] = $this->data['options']['3']['options_value'];
			$data['category'] = $this->data['category'];
			$data['cur_cate'] = $this->Category_m->get_category_by_cid($data['cateid']);
			$data['hotpic'] = $this->Posts_m->get_hot_newest(10,0,'hot');
			$data['relatepic'] = $this->Posts_m->get_list_by_type('',$data['cateid'],0,10);
			$data['comments_num'] = $this->Posts_m->get_comments_nums($data['picid']);
//echo $data['comments_num'];
			if($data['comments_num']==0)
			{
				$data['comments_size'] = 0;
			}
			else
			{
				$data['comments_size'] = $data['comments_size']>($data['comments_num']-1)?($data['comments_num']-1):$data['comments_size'];//如果超过了限制就用最大的
			}
			
			$data['comments'] = $this->Posts_m->get_comments_by_id($data['posts']['0']['posts_id'],$data['comments_size'],$this->data['perpage']);	 		
			$data['perpage'] = $this->data['perpage'];
			
			$this->load->library('pagination');
//      		$config['base_url'] = site_url('pictures/'.$data['picid']);
		$config['base_url'] = base_url()."index.php/pictures/".$data['picid'];
//	        $config['total_rows'] = count($pics);
	        $config['total_rows'] = $data['comments_num'];
//	        $config['per_page'] = $this->data['pic_perpage'];
	        $config['per_page'] = 3;
	        $config['uri_segment'] = 3;
	        $config['num_links'] = 3;
	        $config['first_link'] = '第一页';
	        $config['next_link'] = '下一页';
	        $config['prev_link'] = '上一页';
	        $config['last_link'] = '最后一页';
//	        $config['page_query_string'] = false;//get分页的关键
	        $this->pagination->initialize($config);
	        $data['page_links']=$this->pagination->create_links();
//	       var_dump($config);exit(); 
			/* //这里有ajax的评论不能用缓存
			$cache = unserialize($this->data['options']['4']['options_value']);
			if($cache['cache_enabled'])
			{
				$this->output->cache($cache['cache_expire_time']);
			}
			*/

			session_start();
			$_SESSION['captcha'] = rand(0,1000);
			$data['captcha_check'] = $_SESSION['captcha'];

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
		session_start();
		echo '<html><head><meta http-equiv="content-type" content="text/html;charset=utf-8"></head>';
		if($this->input->post('captcha',true))
		{
			$_SESSION['captcha'] = $this->input->post('captcha',true);
			exit();
		}
		if($this->input->post('comments_posts_id', TRUE)==''||$this->input->post('text', TRUE)==''||$_SERVER['HTTP_REFERER']!=site_url('pictures').'/'.$this->input->post('comments_posts_id', TRUE))
		{
			echo $this->input->post('text', TRUE);
			echo '<script>
					alert("留言内容不能为空");
					location = "'.site_url('pictures').'/'.$this->input->post('comments_posts_id', TRUE).'";'
				.'</script>';
				//Header("Location:".site_url('pictures').'/'.$this->input->post('comments_posts_id', TRUE));
		
				exit();
		}
		$comments = array(
			'comments_posts_id' => $this->input->post('comments_posts_id', TRUE),
			'comments_time'		=> time(),
			'comments_author'	=> $this->input->post('author', TRUE)!=''?$this->input->post('author', TRUE):'日新网友',
			'comments_text'		=> strip_tags($this->input->post('text', TRUE)),
			'comments_ip'		=> $this->input->ip_address(),
		);
		if($_SESSION['captcha']==$this->input->post('captcha_check', TRUE) && $this->check_spam($this->input->post('text', TRUE)))
		{
			$comments_bool = $this->Posts_m->comments_insert($comments);
			if($comments_bool)
			{
				Header("Location:".site_url('pictures').'/'.$this->input->post('comments_posts_id', TRUE));
				exit();
			}
		}
		else
		{
			echo '<script>
					alert("comment error!");
					location = "'.site_url('pictures').'/'.$this->input->post('comments_posts_id', TRUE).'";'
				.'</script>';
				exit();
		}
	}

	function check_spam($string)
	{
	    $strlen = mb_strlen($string); 
	    $strlen_ = $strlen;
	    if($strlen < 40){
	    	return TRUE;
	    }
	    $en_len = 0;
	    while ($strlen) { 
	        if(strlen(mb_substr($string,0,1,"UTF-8")) == 1){
	        	$en_len += 1;
	        } 
	        $string = mb_substr($string,1,$strlen,"UTF-8"); 
	        $strlen = mb_strlen($string); 
	    }
	    if($en_len/$strlen_ > 0.9){
	    	return FALSE;
	    }else{
	    	return TRUE;
	    }
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
	
	//上一个函数不知道能不能修改，所以重新写了这个
	function comments($picid, $page)
	{
		$perpage = 3;
		$comments = $this->Posts_m->get_comments_by_id($picid, $page*$perpage, $perpage);
		$comments_rows = $this->Posts_m->get_comments_nums($picid);
		echo json_encode(array(
			'cur_page'=>$page,
			'total_page'=>ceil($comments_rows/$perpage),
			'comments_count'=>count($comments),
			'comments'=>$comments
		));
		exit();
	}

	function thumb()
	{
		$pic = str_replace('_', '/', $this->uri->segment(3));
		$type = $this->uri->segment(2);
		$target_width =  150;
		$target_height = 150;
		if(intval($type))
		{
			switch ($type)
			{
				case 1:
					$target_width = 230;
					$target_height = 144;
					break;
				  break;
				case 2:
					$target_width = 203;
					$target_height = 136;
				  break;
				case 3:
					$target_width = 130;
					$target_height = 144;
				  break;
				case 4:
					$target_width = 478;
					$target_height = 271;
				  break;
				case 5:
					$target_width = 230;
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
	    $this->_create_thumb($pic,$target_width,$target_height,$type);
	}
	function _create_thumb($uploadfile,$target_width,$target_height,$type) {
	/*
    $img = imagecreatefromjpeg($uploadfile);
    $width = imageSX($img);
    $height = imageSY($img);
	*/
	$arr=getimagesize($uploadfile);
	$width = $arr['0'];
    $height = $arr['1'];
    
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
	$thumbfile = str_replace('.jpg','_'.$type.'.jpg',$uploadfile);
	if(!file_exists($thumbfile))
	{
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = $uploadfile;
	    $config['create_thumb'] = TRUE;
	    $config['maintain_ratio'] = TRUE;
	    $config['maintain_quality'] = 70;
	    $config['new_image'] = $thumbfile;
	    $config['thumb_marker'] = '';
	    $config['width'] = $new_width;
	    $config['height'] = $new_height;
	
	    $this->image_lib->initialize($config);
	    $this->image_lib->resize();
	}
    //$this->image_lib->clear();
    
	$config['source_image']=$thumbfile;
    $config['maintain_ratio']=FALSE;
    $config['create_thumb'] = TRUE;
    $config['dynamic_output'] = TRUE;
    $config['width'] = $target_width;
    $config['height'] = $target_height;
    $config['x_axis'] = ($new_width-$target_width)/2 ;
    $config['y_axis'] = ($new_height-$target_height)/6;
    $this->image_lib->initialize($config);
   // $this->image_lib->crop();
	if(!$this->image_lib->crop())
	{
		echo $this->image_lib->display_errors();

	}
  }
}
?>
