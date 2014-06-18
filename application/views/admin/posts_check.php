<?php include 'header.php'; ?>
<h2>
<div class="ico_cate"></div>图集管理 <input onclick="window.location.href='<?php echo site_url('admin/posts/post_add');?>'" type="button" class="btn" value="新增图集" style="position: absolute; left: 200px; top: 80px;" />
<div id="search">
	<form method="get" action="<?php echo site_url('admin/posts/search');?>">
	    <input type="text" onclick="value='';name='keywords';" value="请输入关键字">
	    <select name="category">
	    	<option value="0">所有分类</option>
	    <?php foreach ($category as $row):?>
			<option value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
		<?php endforeach;?>
	    </select>
	    <button type="submit">筛选</button>
	</form>
</div>
<div id="category">
分类管理：
<?php foreach ($category as $row):?>
<span class="cate">
	<?php echo anchor('admin/posts/post_cate/'.$row['category_id'],$row['category_name']); ?>
</span>
<?php endforeach;?>
<span class="check">
	<a>进行审核...</a>
</span>
</div>
</h2>
<table class="tablelist">
  <tr>
    <th width="200px">标题</th>
    <th width="100">别名</th>
    <th width="100">图片数</th>
    <th width="100">分类</th>
    <th width="100">类型</th>
    <th width="100">点击数</th>
    <th width="100">审核</th>
    <th>发布时间</th>
    <th width="100">操作</th>
  </tr>
  <?php foreach ($post_list as $row) { ?>
  <tr align="center">
    <td><?php echo anchor('admin/posts/view/'.$row['posts_id'],$row['posts_title']); ?></td>
    <td><?php echo $row['posts_slug']; ?></td>
    <td><?php echo intval($row['posts_count']); ?></td>
    <td><?php echo anchor('admin/posts/post_cate/'.$row['category_id'],$row['category_name']); ?></td>
    <td><?php
        switch ($row['posts_type']) {
          case 1:
            echo '推荐';
            break;
          case 2:
            echo '焦点';
            break;
        }
        ?></td>
    <td><?php echo intval($row['posts_hit']); ?></td>
    <td>
    <?php
        switch ($row['posts_check']) {
          case 0:
            echo anchor('admin/posts/post_check/'.$row['posts_id'],'审核通过');
            break;
          case 1:
            echo '已审核';
            break;
        }
    ?>
    </td>
    <td><?php echo date('Y-m-d H:i:s',$row["posts_pubdate"]); ?></td>
    <td><?php echo anchor('admin/posts/del/'.$row['posts_id'],'删除'); ?></td>
  </tr>
    <?php } ?>
</table>
<div class="pages"><?php echo $page; ?></div>
<?php include 'footer.php'; ?>
