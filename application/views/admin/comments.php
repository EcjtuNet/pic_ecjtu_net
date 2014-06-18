<?php include 'header.php'; ?>
<h2>
<div class="ico_cate"></div>评论管理
<div id="category">
分类管理：
<?php foreach ($category as $row):?>
<span class="cate">
	<?php echo anchor('admin/comments/comment_cate/'.$row['category_id'],$row['category_name']); ?>
</span>
<?php endforeach;?>
</div>
</h2>
<table class="tablelist">
  <tr>
    <th width="150px">网友昵称</th>
    <th >评论内容</th>
    <th width="150">时间</th>
    <th width="150">ip地址</th>
    <th width="150">评论图集</th>
    <th width="150">操作</th>
  </tr>
  <?php foreach ($comments_list as $row) { ?>
  <tr align="center">
    <td><?php echo $row['comments_author']; ?></td>
    <td><?php echo $row['comments_text']; ?></td>
    <td><?php echo date('Y-m-d H:i:s',$row['comments_time']); ?></td>
    <td><?php echo $row['comments_ip']; ?></td>
    <td><?php echo $row['posts_title']; ?></td>
    <td><?php echo anchor('admin/comments/del/'.$row['comments_id'],'删除'); ?></td>
  </tr>
    <?php } ?>
</table>
<div class="pages"><?php echo $page; ?></div>
</div>
</div>
<?php include 'footer.php'; ?>
