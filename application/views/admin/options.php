<?php include 'header.php'; ?>
<h2><div class="ico_cate"></div>系统设置</h2>
<form action="<?php echo site_url('admin/options/options_change'); ?>" method="post">
<table class="tablelist" width="600px" style="text-align:center;">
  <tr>
    <th width="400px">名称</th>
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
	清除缓存:<?php echo anchor(site_url('admin/options/cache_clear'),'点击此处清除缓存');?>
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
<?php include 'footer.php'; ?>
