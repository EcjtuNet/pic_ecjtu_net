<?php include 'header.php'; ?>
<h2>
<div class="ico_cate"></div>管理记录
<p><a href=""></a></p>
</h2>
<dl class="box" style="width: 96%;">
  <div id="scoll_liu">
               <div id="scoll_liuImg" class="liuImg"><img src="<?php echo base_url();?>/images/says.gif" /></div>
               <div id="scoll_liuDott"></div>
               <?php 
					foreach ($comments_list as $row): ?>
					<div class="scoll_liuContainer"><!--留言二-->
	                  <div class="scoll_liuTit"><span class="liuName"><?php echo $row->message_name;?></span><span class="liuDate"><?php echo $row->message_date;?></span></div>
	                  <div class="scoll_liuR"><?php echo $row->message_content;?></div>
	                  <div class="scoll_liuX"></div>
	               </div>
					<?php endforeach;?>
			   <div id="page_style"><a><?php echo $this->pagination->create_links();?></a></div>
			   
               <div id="scoll_liuImg2" class="liuImg"><img src="<?php echo base_url();?>/images/says2.gif" /></div>
              <form action="<?php echo site_url('admin/admin_comments/insertMessage')?>" method="post">
               <input type="text" name="admin_name" class="admin_name" onfocus="value='';" value="输入名字">
               <div id="txt"><textarea name="admin_content" onfocus="value='';">来说一点什么吧！</textarea></div>
               <div id="liu_return"><div id="liu_tishi">按Ctrl+Enter快速回复</div><div id="liu_but"><input type="submit" value="发表留言" id="admin_comments"/></div></div>
               </form>
               <script type="text/javascript">
               
               function keyDown(event){
					var admin_comments = document.getElementById('admin_comments');
					event = event?event:window.event;
					event.target?event.target:event.srcElement;
					if(event.ctrlKey && event.keyCode==13){
						admin_comments.click();
					}
               }
               document.onkeydown = keyDown;	
			 </script>
               <div id="liu_space"></div>
            </div>
</dl>
</div>
</div>
<?php include 'footer.php'; ?>
