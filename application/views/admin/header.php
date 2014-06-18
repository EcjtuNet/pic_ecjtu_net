<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex,nofollow">
    <title><?php echo $website; ?>—后台管理</title>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>ui/css/admin_style.css" />
  </head>
  <body>
    <div class="head">
     <div class="header_logo"><img src="<?php echo base_url();?>/images/logo.gif"></img></div><h1 class="logo"><?php echo $website; ?>管理系统</h1>
    </div>
    <div class="main">
    <div class="mid" id="show_mid">
         <div id="show_list">
             <div id="show_lAll" class="show_m"><div id="allLog"></div><div >后台首页</div></div>
             <a href="<?php echo site_url('admin/home');?>"><div id="show_lFJ" class="show_m"><div id="fjLog"></div><div class="listTxt">网站概况</div></div></a>
             <a href="<?php echo site_url('admin/category');?>"><div id="show_lCY" class="show_m"><div id="cyLog"></div><div class="listTxt">分类管理</div></div></a>
             <a href="<?php echo site_url('admin/comments');?>"><div id="show_lGS" class="show_m"><div id="gsLog"></div><div class="listTxt">评论管理</div></div></a>
             <a href="<?php echo site_url('admin/posts');?>"><div id="show_lQC" class="show_m"><div id="qcLog"></div><div class="listTxt">图集管理</div></div></a>
             <a href="<?php echo site_url('admin/posts/post_add');?>"><div id="show_lJY" class="show_m"><div id="jyLog"></div><div class="listTxt">添加图集</div></div></a>
             <a href="<?php echo site_url('admin/admin_comments');?>"><div id="show_lTX" class="show_m"><div id="txLog"></div><div class="listTxt">管理记录</div></div></a>
             <a href="<?php echo site_url('admin/login/logout');?>"><div class="show_m"><div></div><div class="listTxt">帐号退出</div></div></a>
         </div>
         <div id="show_con"><!--右侧展示-->
             <div id="show_tit"></div>