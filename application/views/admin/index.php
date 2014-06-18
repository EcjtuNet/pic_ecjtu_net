<?php include 'header.php'; ?>
             <h2>
				<div class="ico_cate"></div>图集管理
				<p><a href=""></a></p>
			</h2>
             <div>
             
             </div>
            <div style="overflow:hidden;height:440px;margin-top:5px;background:#fff;margin-left:5px;">
            <dl class="box" style="width: 100%;margin-top:10px;">
               <dt>服务器概况</dt>
               <table class="table">
			      <tr><td width="100px">主机名</td><td><?php echo $_SERVER['SERVER_NAME'] ; ?></td></tr>
			      <tr><td>服务器版本</td><td><?php echo $_SERVER['SERVER_SOFTWARE'] ; ?></td></tr>
			      <tr><td>登录IP</td><td><?php echo $_SERVER['REMOTE_ADDR']; ?></td></tr>
			      <tr><td>浏览器</td><td><?php echo $_SERVER['HTTP_USER_AGENT']; ?></td></tr>
			   </table>
			 </dl>  
            <form action="<?php echo site_url('admin/home/options_change'); ?>" method="post" style="margin-top:160px;">
				<table class="tablelist" width="500px" style="text-align:center;">
				  <tr>
				    <th width="400px">系统配置</th>
				    <th>设置</th>
				  </tr>
				  <?php 
				  foreach ($options as $row) { 
				  	if($row['options_slug']=='cache'){
				  		$cache = unserialize($row['options_value']);
				  ?>
				  <tr>
				  	<td align="center"><?php echo $row['options_name']; ?></td>
				  	<td align="left">
				  	<span>
					<input name="cache_enabled" type="radio" value="0" id="cache_enabled" <?php echo $cache['cache_enabled']==0?'checked=checked':''; ?> />
					<label for="cache_enabled">
					不启用</label>
					</span>
					<span>
					<input name="cache_enabled" type="radio" value="1" id="cache_enabled_1" <?php echo $cache['cache_enabled']==1?'checked=checked':'';; ?>/>
					<label for="cache_enabled_1">
					启用</label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label class="typecho-label" for="cache_expire_time">缓存自动刷新时间</label>
					<input id="cache_expire_time" name="cache_expire_time" type="text" class="mini" value="<?php echo $cache['cache_expire_time']; ?>" /> 分钟
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					清除缓存:<?php echo anchor(site_url('admin/home/cache_clear'),'点击此处清除缓存');?>
					</td>
				  </tr>
				  <?php break;}?>
				   <tr>
				    <td align="center"><?php echo $row['options_name']; ?></td>
				    <td align="left"><input size="60" type="text" name="<?php echo $row['options_slug']; ?>" value="<?php echo $row['options_value']; ?>" /></td>
				  </tr>
				  <?php } ?>
				  <tr><td></td><td align="center"><input type="submit" value="修改" class="btn" /></td></tr>
				</table>
			</form>
          </div> 
          <dl class="box" style="width: 100%;">
			  <dt>最近发布图集</dt>
			  <dd>
			  <table class="table">
			  <?php foreach ($recent_post as $row):?>
			  	<tr><td align="center" style="width: 300px;">标题:
			  	<?php echo anchor('pictures/'.$row['posts_id'],$row['posts_title']); ?></td><td align="left">时间:<?php echo date('Y-m-d',$row['posts_pubdate']);?>
			  	</td></tr>
			  <?php endforeach;?>
			  </table>
			  </dd>
			</dl>
		         
         </div>    
    </div>
<?php include 'footer.php'; ?>
