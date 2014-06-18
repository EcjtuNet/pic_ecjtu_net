<?php include 'header.php'; ?>
<h2><div class="ico_cate"></div>分类管理</h2>
<dl class="box" style="width: 100%;margin:0 auto;">
  <dt>新增分类栏目</dt>
  <dd>
  	<form id="form" name="form" action="<?php echo site_url('admin/category/cate_add'); ?>" method="post"  onsubmit="return check()">
      <table class="table">
        <tr><td align="right" width="200">栏目名称：</td><td width="200"><input id="post_title" size="50" type="text" name="category_name" value="" /></td></tr>
        <tr><td align="right" width="200">栏目别名(用拼音或者英文)：</td><td width="200"><input type="text" size="50" name="category_slug" value="" /></td></tr>
        <tr><td align="right" width="200">栏目关键字(搜索引擎友好)：</td><td width="200"><input id="post_title" size="50" type="text" name="category_keywords" value="" /></td></tr>
        <tr><td align="right" width="200">栏目描述：</td><td width="200"><input id="post_title" size="50" type="text" name="category_description" value="" /></td></tr>
        <tr><td></td><td width="70"><input type="submit" value="确认添加" class="btn" /></td></tr>
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