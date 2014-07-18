<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="日新 图片 交大 华东交通大学 图库 图说" />
<title>日新图库</title>
<link href="<?php echo base_url(); ?>css/index.css"  type="text/css" rel="stylesheet" />
</head>

<body>
<div class="container">
    <div class="header">
           <div class="headerMid">
              <div class="logo"><a  href="http://pic.ecjtu.net"><img src="<?php echo base_url(); ?>images/logo.gif" /></a></div>
              <div class="shouye"><a style="display:block;width:100%;height:100%" href="http://www.ecjtu.net/"></a></div>
              <div class="new"><a style="display:block;width:100%;height:100%" href="http://www.ecjtu.net/html/ecjtunews1/" target=_blank></a></div>
              <div class="tushuo"><a style="display:block;width:100%;height:100%" href="<?php echo site_url(); ?>" ></a></div>
           </div>    
    </div>
    <div class="mid" id="show_mid">
         <div id="show_list">
             <!--<a href="<?php echo base_url(); ?>index.php/list/0/"><div id="show_lAll" class="show_m"><div id="allLog"></div><div class="listTxt">全部</div></div></a>
             <a href="<?php echo base_url(); ?>index.php/list/1/"><div id="show_lFJ" class="show_m"><div id="fjLog"></div><div class="listTxt">风景</div></div></a>
             <a href="<?php echo base_url(); ?>index.php/list/1/"><div id="show_lCY" class="show_m"><div id="cyLog"></div><div class="listTxt">创意</div></div></a>
             <div id="show_lGS" class="show_m"><div id="gsLog"></div><div class="listTxt">故事</div></div>
             <div id="show_lQC" class="show_m"><div id="qcLog"></div><div class="listTxt">青春</div></div>
             <div id="show_lJY" class="show_m"><div id="jyLog"></div><div class="listTxt">记忆</div></div>
             <div id="show_lTX" class="show_m"><div id="txLog"></div><div class="listTxt">天下</div></div>-->
			 <div id="show_lQC" style="background:#0d0d0d;color:#585858;height:50px; font-size:22px;line-height:50px;width:150px;text-align:center;"></div>
			 <a href="<?php echo base_url(); ?>index.php/list/0/"><div id="show_lAll" class="show_m"><div id="allLog"></div><div class="listTxt">全部</div></div></a>
			 <?php
			 foreach($cate as $val)
			 echo '<a href="'.base_url().'index.php/list/'.$val['id'].'/"><div id="show_lFJ" class="show_m"><div id="fjLog"></div><div class="listTxt">'.$val['name'].'</div></div></a>';
			 
			 ?>
         </div>
         <div id="show_con"><!--右侧展示-->
             <div id="show_tit"></div>
             <div id="show_logTxt">最新上传的图集</div>
             <!--<div class="show_pic show_picF" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic show_picF" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic show_picF" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic show_picF" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic show_picF" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>
             <div class="show_pic" ><img src="<?php echo base_url(); ?>newImages/show1.jpg" /></div>-->
			 <?php
			 foreach($newestpic as $val)
			 {echo'<div class="show_pic">
				<a style="display:block;width:100%;height:100%;" href="'.site_url('pictures/'.$val['posts_id']).'">
				<img style="display:block;width:100%;height:100%;" src="'.site_url('thumb/'.'2/'. str_replace('/','_',$val['posts_thumb'])).'"  alt="'.$val['posts_title'].'" title="'.$val['posts_title'].'" />
				<div style="width:210px;top:97px;" class="dj">
					<p>[图集]'.$val['posts_title'].'</p>
					<p>点击:'.$val['posts_hit'].'</p>
				</div>
				</a>
			</div>';
			}
			?>
             <!--<div id="show_page"><div id="leftPage"><img src="<?php echo base_url(); ?>images/left.gif" /></div>
			 <ul id="pageNum"><li>1</li><li>2</li><li>3</li></ul>
			 <div id="rightPage"><img src="<?php echo base_url(); ?>images/right.gif" /></div></div>-->
			 <div id="show_page"><?php echo $page_links; ?></div>
             
         </div>

          
          
    </div>
    <div class="bot">
            <div class="bot_icp bot_address">华东交通大学团委、学工处 [ 版权所有 交大日新  ]  赣ICP备05003322 日新工作室 维护 </div>
            <div class="bot_add bot_address">邮箱：<a href="#">214@ecjtu.net</a> CopyRight 2001-2011 By [ecjtu.net] .All Rights Reserved</div>
    </div>
</div>
</body>
</html>
