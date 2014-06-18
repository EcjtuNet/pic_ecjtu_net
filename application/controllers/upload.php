<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends CI_Controller 
{
	private $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Options_m');
		$this->load->model('Category_m');
		$this->load->model('Posts_m');
		$this->data['options'] = $this->Options_m->get_options();
		$this->data['category'] = $this->Category_m->get_category();
		$cache = unserialize($this->data['options']['4']['options_value']);
		if($cache['cache_enabled'])
		{
			//echo $cache['cache_expire_time'];exit();
			$this->output->cache($cache['cache_expire_time']);
		}
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
	function index()
	{
		$data['webtitle'] = $this->data['options']['0']['options_value'];
		$data['keywords'] = $this->data['options']['1']['options_value'];
		$data['description'] = $this->data['options']['2']['options_value'];
		$data['copyright'] = $this->data['options']['3']['options_value'];
		$data['category'] = $this->data['category'];
		$data['cateid']=0;
		$this->load->view('upload',$data);
	}
	
	function upload_add()
	{
	    if(isset($_POST['pictures']))
	    {
	    	$pictures = $_POST['pictures'];
	    }
	    else
	    {
	    	echo '<script>
					alert("请上传图片~");
					location = "'.site_url('upload').'";'
				.'</script>';
				exit();
	    }
	    
	    $post_category = isset($_POST['category'])?$_POST['category']:0;
	    $thumbfile = '';
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
            'posts_slug'=>$_POST['title'],
            'posts_category'=>$post_category,
            'posts_author' => isset($_POST['author'])?$_POST['author']:'日新网友',
            'posts_type'=>0,
            'posts_keywords' => $_POST['title'],
            'posts_description'=>isset($_POST['description'])?$_POST['description']:'',
            'posts_thumb'=>$thumbfile,
            'posts_check'=>0,
            'posts_pubdate'=>time(),
            'posts_hit'=>0,
            'posts_pictures'=>serialize($pictures),
            'posts_count'=>0
	    );
      if($this->Posts_m->post_insert($data)) {
	      	$ms['webtitle'] = $this->data['options']['0']['options_value'];
			$ms['keywords'] = $this->data['options']['1']['options_value'];
			$ms['description'] = $this->data['options']['2']['options_value'];
			$ms['copyright'] = $this->data['options']['3']['options_value'];
			$ms['category'] = $this->data['category'];
			$ms['cateid']=0;
      		$ms['msgtitle']='上传成功';
	        $ms['msgcontent']='请等待后台审核通过~';
	        $ms['gotourl']="window.location.href='".site_url('upload')."'";
	        $this->load->view('message',$ms);
      }else {
       		$ms['webtitle'] = $this->data['options']['0']['options_value'];
			$ms['keywords'] = $this->data['options']['1']['options_value'];
			$ms['description'] = $this->data['options']['2']['options_value'];
			$ms['copyright'] = $this->data['options']['3']['options_value'];
			$ms['category'] = $this->data['category'];
			$ms['cateid']=0;
      		$ms['msgtitle']='上传失败';
	        $ms['msgcontent']='请重试~';
	        $ms['gotourl']="window.location.href='".site_url('upload')."'";
	        $this->load->view('message',$ms);
      }
	}
}
?>