<?php
class Picture extends CI_Controller{
  function  __construct() {
    parent::__construct();
  }
  function index() {
  }
  function do_upload()
  {
	if (isset($_POST["PHPSESSID"])) {
	  session_id($_POST["PHPSESSID"]);
	}
	session_start();
	ini_set("html_errors", "0");
	if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
	  echo "ERROR:非法上传";
	  exit(0);
	}
	$filename=md5($_FILES['Filedata']['tmp_name'].time());
	$attdir='pic/'.date('Ym');
	if(!is_dir($attdir)) mkdir($attdir);
	$attdir=$attdir.date('/d');
	if(!is_dir($attdir)) mkdir($attdir);
	$uploadfile = "$attdir/$filename.jpg" ;
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $uploadfile );
		$this->load->library('image_lib');
	$config['source_image'] = $uploadfile;
	$config['wm_type'] = 'overlay';
	$config['wm_overlay_path'] = 'ui/images/WWW.ECJTU.png';
	$config['wm_vrt_alignment'] = 'bottom';
	$config['wm_hor_alignment'] = 'right';
    //暂时去掉水印功能
	//$this->image_lib->initialize($config); 
	//$this->image_lib->watermark();
	echo "FILEID:" . str_replace('/', '_', $uploadfile);
  }
  
  function thumb($uploadfile) {
  	$uploadfile = str_replace('_','/',$uploadfile);
    if( ! file_exists($uploadfile) ) {
      exit(0);
    }
    $config['image_library'] = 'gd2';
    $config['source_image'] = $uploadfile;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['dynamic_output'] = TRUE;
    $config['width'] = 160;
    $config['height'] = 120;
    $this->load->library('image_lib', $config);
    $this->image_lib->resize();
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
}
