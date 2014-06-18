<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-CN">
  <head>
    <title><?php echo $website;?>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel='stylesheet' id='login-css' href='<?php echo base_url();?>ui/css/login.css' type='text/css' media='all' />
    <meta name='robots' content='noindex,nofollow' />
  </head>
  <body class="login">
    <div id="login">
      <h1><?php echo $website;?><span id="sub"> 后台管理系统登录</span></h1>
      <?php if(isset ($err) && $err!==''){
        echo '<div id="login_error" >'.$err.'</div>';
      }?>
      <form name="loginform" id="loginform" action="<?php echo site_url('admin/login/check') ?>" method="post">
        <p><label>用户名<br /><input type="text" name="username" id="user_login" class="input" value="" size="20" tabindex="10" /></label></p>
        <p><label>密码<br /><input type="password" name="password" id="user_pass" class="input" value=""  size="20" tabindex="20" /></label></p>
        <p class="submit"><input type="submit" name="submit" id="submit"  value="登录" tabindex="100" /></p>
      </form>
    </div>
    <p id="back"><a href="<?php echo base_url();?>" title="不知道自己在哪？">&larr; 返回 网站首页</a></p>
  </body>
</html>