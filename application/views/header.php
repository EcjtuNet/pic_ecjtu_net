<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $webtitle; ?></title>
<base href="<?php echo site_url(); ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<link rel="stylesheet" type="text/css" href="css/index.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.js"></script>
</head>
<body>
<div id="cboxOverlay">
 
  <div id="tuji2">
            <div id="open_close">×</div>
            <div id="left_but2"><img src="images/btn_arrow_press.gif" /></div>
            <div id="tuji_show2">
				<div id="tuji_show_containner2">
			<?php foreach ($pictures as $rs):?>
			    <img src="<?php echo base_url($rs);//site_url('thumb/'.'2/'.str_replace('/','_',$rs)); ?>" class="tuji_class2" />
			<?php endforeach; ?> 
				</div>
			</div>
            <div id="right_but2"><img src="images/btn_arrow.gif" /></div>
			
  </div>
</div>
<div class="container">
<div style="margin:0;" class="header">
           <div class="headerMid">
              <div class="logo"><a href="http://pic.ecjtu.net"><img src="<?php echo base_url();?>/images/logo.png"/></a></div>
              <div class="shouye"><a style="display:block;" href="http://www.ecjtu.net/" target=_blank></a></div>
              <div class="new"><a style="display:block;" href="http://www.ecjtu.net/html/ecjtunews1/" target=_blank></a></div>
              <div class="tushuo"><a style="display:block;" href="<?php echo site_url(); ?>" ></a></div>
           </div>    
</div>
