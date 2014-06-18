<?php include 'header.php'; ?>
<h2><div class="ico_cate"></div>分类管理</h2>
<dl class="box" style="width: 100%;margin:0 auto;">
  <dt>修改分类栏目</dt>
  <dd>
  	<form id="form" name="form" action="<?php echo site_url('admin/category/cate_change'); ?>" method="post"  onsubmit="return check()">
      <table class="table">
        <tr><td align="right" width="200">栏目名称：</td><td width="200"><input id="post_title" size="50" type="text" name="category_name" value="<?php echo $cate_info['0']['category_name']?>" /></td></tr>
        <tr><td align="right" width="200">栏目别名(用拼音或者英文)：</td><td width="200"><input type="text" size="50" name="category_slug" value="<?php echo $cate_info['0']['category_slug']?>" /></td></tr>
        <tr><td align="right" width="200">栏目关键字(搜索引擎友好)：</td><td width="200"><input id="post_title" size="50" type="text" name="category_keywords" value="<?php echo $cate_info['0']['category_keywords']?>" /></td></tr>
        <tr><td align="right" width="200">栏目描述：</td><td width="200"><input id="post_title" size="50" type="text" name="category_description" value="<?php echo $cate_info['0']['category_description']?>" /></td></tr>
        <input id="post_title" size="50" type="hidden" name="category_id" value="<?php echo $cate_info['0']['category_id']?>" />
        <tr><td></td><td width="70"><input type="submit" value="确认修改" class="btn" /></td></tr>
      </table>
    </form>
  </dd>
</dl>
<script type="text/javascript">
     function check()
     {
         for(var i=0;i<document.form.elements.length-1;i++)
         {
             if(document.form.elements[i].value=="")
             {
                alert("当前表单不能有空项");
                document.form.elements[i].focus();
                return false;
                break;
             }
         }
         return true;   
     }
</script>
</div>
</div>
<?php include 'footer.php'; ?>