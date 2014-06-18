<?php include 'header.php'; ?>
<h2>
<div class="ico_cate"></div>
<p>添加图集</p>
</h2>
<dl class="box" style="width: 96%;">
  <dd><form id="form" name="form" action="<?php echo site_url('admin/posts/add'); ?>" method="post" >
      <table class="table">
        <tr><td align="right" width="200">标题：</td><td><input id="post_title" size="50" type="text" name="title" value="" /></td></tr>
        <tr><td align="right">作者：</td><td><input id="post_author" size="50" type="text" name="author" value="admin"/></td></tr>
        <tr><td align="right">别名：</td><td><input type="text" name="slug" value="" /></td></tr>
        <tr><td align="right">分类：</td>
          <td><select id="post_cate" name="category">
              <option value="0">无分类</option>
              <?php foreach($category as $row) {
                echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
              }
              ?>
            </select>
          </td></tr>
        <tr><td align="right">类型：</td><td><input type="radio" name="type" value="0"/>不推荐 <input type="radio" name="type" value="1" />推荐 <input type="radio" name="type" value="2"/>焦点</td></tr>
        <tr><td align="right">描述：</td><td>
        	<textarea cols="50" rows="5" id="b" name="description" ></textarea>
			<span id="a">已输入字符: </span>
			<script language="javascript">
			<!--
			var ppl=70//每条长
			var maxl=140//总长
			document.onkeydown=function(){
			   var s=document.getElementById("b").value.length +1;
			   if(s>maxl)document.getElementById("b").value=document.getElementById("b").value.substr(0,maxl-1)
			   else document.getElementById("a").innerHTML="已输入："+s+"/"+maxl+" 字符"
			}
			function cha(){
			var txt=document.getElementById("b").value,tl=txt.length;
			var txtArray=[],k=(tl/ppl<=1)?1:Math.ceil(tl/ppl);
			for (var i=0;i<k;i++){
			txtArray[i]=txt.substr(i*ppl,ppl);
			alert(txtArray[i]) ;
			}
			document.getElementById("b").value=""
			document.getElementById("a").innerHTML="已输入字符: "
			}
			//-->
			</script>
        </td></tr>
        <tr><td align="right">点击数：</td><td><input type="text" name="hit" value="" /></td></tr>
        <tr><td align="right" valign="top">图片：</td><td>
            <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding:2px; line-height: 20px;">
              <span id="spanButtonPlaceholder"></span>
            </div>
            <div id="divFileProgressContainer"></div>
            <div id="thumbnails">
            </div>
          </td></tr>
        <tr><td align="right">缩略图：</td><td><input size="50" type="hidden" name="thumb" value="" />&nbsp;&nbsp;选择第<input size="2" type="text" name="select_thumb"/>张图片作为封面</td></tr>
        <tr><td></td><td><input type="button" value="添加" class="btn" onclick="check();" /></td></tr>
      </table>
    </form>
  </dd>
</dl>
<script type="text/javascript" src="<?php echo base_url();?>ui/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>ui/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>ui/js/handlers.js"></script>
<script type="text/javascript">
  var swfu;
  window.onload = function () {
    swfu = new SWFUpload({
      // Backend Settings
      upload_url: "<?php echo site_url('admin/picture/do_upload'); ?>",
      post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},

      // File Upload Settings
      file_size_limit : "2 MB",	// 2MB
      file_types : "*.jpg;*.PNG;*.GIF;*.BMP;*.JPEG;*.TIFF;*.TGA",
      file_types_description : "上传图片",
      file_upload_limit : "0",

      // Event Handler Settings - these functions as defined in Handlers.js
      //  The handlers are not part of SWFUpload but are part of my website and control how
      //  my website reacts to the SWFUpload events.
      file_queue_error_handler : fileQueueError,
      file_dialog_complete_handler : fileDialogComplete,
      upload_progress_handler : uploadProgress,
      upload_error_handler : uploadError,
      upload_success_handler : uploadSuccess,
      upload_complete_handler : uploadComplete,

      // Button Settings
      button_image_url : "<?php echo base_url()?>ui/img/SmallSpyGlassWithTransperancy_17x18.png",
      button_placeholder_id : "spanButtonPlaceholder",
      button_width: 240,
      button_height: 18,
      button_text : '<span class="button">选择图片<span class="buttonSmall">(单文件最大2MB，可多选)</span></span>',
      button_text_style : '.button { font-size: 12px; } .buttonSmall { font-size: 11px; }',
      button_text_top_padding: 0,
      button_text_left_padding: 18,
      button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
      button_cursor: SWFUpload.CURSOR.HAND,
      // Flash Settings
      flash_url : "<?php echo base_url()?>ui/swf/swfupload.swf",
      custom_settings : {
        upload_target : "divFileProgressContainer"
      },
      // Debug Settings
      debug: false
    });
  };
  
  function check(){
    var post_title=$('#post_title');
    var post_cate=$('#post_cate');
    
    if(post_title.val()==''){
      alert('标题不能为空');
      return;
    }
    if(post_cate.val()==0){
      alert('请选择分类');
      return;
    }
    document.form.submit();
  }
</script>
</div>
</div>
<?php include 'footer.php'; ?>
