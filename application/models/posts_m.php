<?php
class Posts_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_hot_newest($top_num=16,$cate=0,$type)//$cate不设置就是选择全局的TOP，也可以指定$cate让一个类中的top
	{
		if($cate > 0)
		{
			$this->db->where('posts_category',$cate);
		}
		switch ($type)
		{
			case 'hot':
				$this->db->order_by('posts_hit','desc');
				break;
			case 'newest':
				$this->db->order_by('posts_pubdate','desc');
				break;
		}
		$this->db->where('posts_check',1);
		$this->db->join('category','category_id=posts_category','left');//因为要返回该图集的名称
		return $this->db->get('posts',$top_num)->result_array();
	}
	
	function get_list_by_type($type_id,$cate_id=0,$index=0,$pagesize=16)
	{
		if($type_id!='')
		{
		    $this->db->where('posts_type',$type_id);
		}
		if($cate_id > 0)
		{
			$this->db->where('posts_category',$cate_id);
		}
		$this->db->where('posts_check',1);
		$this->db->order_by("posts_pubdate", "desc");
		return $this->db->get('posts',$pagesize,$index)->result_array();//get()的第二个参数是偏移量，第三个是起点
	}
	
	function get_post_by_id($picid)
	{
		if($picid = intval($picid))
		{
			$this->db->where('posts_id',$picid);
			return $this->db->get('posts')->result_array();
		}
	}
	
	function get_comments_by_id($comment_id,$index=0,$pagesize=5)
	{
		if($comment_id = intval($comment_id))
		{
			$this->db->where('comments_posts_id',$comment_id);
			$this->db->order_by("comments_id", "desc");
			return $this->db->get('comments',$pagesize,$index)->result_array();
		}
	}
	
	function get_comments_nums($pid)
	{
		if(intval($pid))
		{
			$this->db->where('comments_posts_id',$pid);
			
			return $this->db->get('comments')->num_rows();
		}
	}
	
	function get_row_nums($cate_id='',$check=false)//可以按cate_id获取相应记录条数否则直接返回所有条数
	{
		if(intval($cate_id) && $cate_id!='')
		{
			$this->db->where('posts_category',$cate_id);
		}
		if($check==true)
		{
			$this->db->where('posts_check',0);
		}
		return $this->db->get('posts')->num_rows();
	}
	
	function get_comment_num($cate_id='')
	{
		if(intval($cate_id)!='')
		{
			$this->db->join('posts','comments_posts_id=posts_id','left');
			$this->db->where('posts_category',$cate_id);
		}
		return $this->db->get('comments')->num_rows();
	}
	
	function comments_insert($comments = array())
	{
		return $this->db->insert('comments', $comments);
	}
	
	
	function update_hits($picid = 0)
	{
		if($picid>0) 
		{
	      $this->db->query('update '.$this->db->dbprefix('posts').' set posts_hit=posts_hit+1 where posts_id='.$picid);
	    }
	}
/*----------admin------------*/
	function get_list($pageindex=0,$pagesize=10,$cate=false,$check=false)
	{
		$this->db->join('category','category_id=posts_category','left');
		if($check==true)//如果是获取要审核的结果
		{
			$this->db->where('posts_check',0);
		}
		else
		{
			$this->db->where('posts_check',1);
		}
		if($cate>0)
		{
			$this->db->where('posts_category',$cate);
		}
	    $this->db->order_by("posts_pubdate", "desc");
	    $query= $this->db->get('posts',$pagesize,$pageindex);
	    return $query->result_array();
	}
	
	function wait_check_num()
	{
		$this->db->where('posts_check',0);
		return $this->db->get('posts')->num_rows();
	}
	
	function check_ok($pid=0)
	{
		if($pid>0) 
		{
	      $this->db->query('update '.$this->db->dbprefix('posts').' set posts_check=1 where posts_id='.$pid);
	    }
	}
	function search($pageindex=0,$pagesize=10,$keywords,$cid=0,$num=false)
	{
		if($num==true)
		{
			if($cid>0)
			{
				$this->db->where('posts_category',$cid);
			}
			$this->db->like('posts_title',$keywords,'both');
			return $this->db->get('posts')->num_rows();
			exit();
		}
		$this->db->join('category','category_id=posts_category','left');
		if($cid>0)
		{
			$this->db->where('posts_category',$cid);
		}
		$this->db->like('posts_title',$keywords,'both');
		$this->db->order_by("posts_id", "desc");
	 	$query= $this->db->get('posts',$pagesize,$pageindex);
	    return $query->result_array();
	}
	
	function post_update($id=0,$data=array())
	{
    	return $this->db->update('posts', $data,array('posts_id'=>$id));
	}
	
	function post_insert($data=array())
	{
    	return $this->db->insert('posts',$data);
	}
	
	function post_del($pid=0)
	{
		$this->db->select('posts_pictures');
		$this->db->where('posts_id',$pid);
		$tmp = $this->db->get('posts')->result_array();
		$pics = unserialize($tmp['0']['posts_pictures']);
		foreach ($pics as $row)
		{
			$this->delpic($row);
		}
		$this->db->delete('comments', array('comments_posts_id' =>$pid));
		return $this->db->delete('posts', array('posts_id' =>$pid));
	}
	
	function delpic($uploadfile){
  	$uploadfile = str_replace('_','/',$uploadfile);
  	if(file_exists($uploadfile) ) {
      unlink($uploadfile);
    }
  	for($i=1;$i<=4;$i++)
  	{
  		$del = str_replace('.jpg','_'.$i.'.jpg',$uploadfile);
	    if(file_exists($del) ) {
	      unlink($del);
	    }
  	}
  }
    /*----comments-----*/
  	function get_comments($pageindex=0,$pagesize=10,$cate=false)
	{
		$this->db->join('posts','comments_posts_id=posts_id','left');
		$this->db->select('comments_posts_id,comments_id,comments_time, comments_author,comments_text,comments_ip,posts.posts_title');
		if($cate>0)
		{
			$this->db->where('posts_category',$cate);
		}
	    $this->db->order_by("comments_id", "desc");
	    $query= $this->db->get('comments',$pagesize,$pageindex);
	    return $query->result_array();
	}
	
	function comments_del($cid)
	{
		return $this->db->delete('comments', array('comments_id' =>$cid));
	}
}
?>