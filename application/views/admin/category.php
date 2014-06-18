<?php include 'header.php'; ?>
        <h2><div class="ico_cate"></div>分类栏目<input type="button" style="position: absolute; left: 200px; top: 40px;" value="新增分类栏目" class="btn" onclick="window.location.href='<?php echo site_url('admin/category/category_add')?>'"></h2>
        <table class="tablelist">
          <tr><th width="200px">名称</th><th width="100">别名</th><th width="100">图集数</th><th width="150">关键字</th><th>描述</th><th width="100">操作</th></tr>
         <?php foreach($category as $rs):?>
          <tr>
            <td align="center"><?php echo $rs['category_name']; ?></td>
            <td align="center"><?php echo $rs['category_slug']; ?></td>
            <td align="center"><?php echo intval($rs['category_count']);?></td>
            <td align="center"><?php echo $rs['category_keywords']; ?></td>
            <td align="center"><?php echo $rs['category_description']; ?></td>
            <td align="center"><a href="<?php echo site_url('admin/category/change/'.$rs['category_slug'])?>">修改</a></td>
          </tr>
            <?php endforeach;?>
        </table>
    </div>
    </div>
<?php include 'footer.php'; ?>
