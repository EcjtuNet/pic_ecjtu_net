<?php include 'header.php'; ?>
<h2>
<div class="ico_cate"></div>图集管理
<p><a href=""></a></p>
</h2>
<dl class="box" style="width: 96%;">
  <dt>修改 <?php echo $post->post_title; ?></dt>
  <dd><form id="form" action="<?php echo site_url('admin/posts/mod'); ?>" method="post" >
      <table class="table">
        <tr><td align="right" width="200">标题：</td><td><input id="post_title" size="50" type="text" name="title" value="<?php echo $post->post_title; ?>" /></td></tr>
        <tr><td align="right">别名：</td><td><input type="text" name="slug" value="<?php echo $post->post_slug; ?>" /></td></tr>
        <tr><td align="right">分类：</td>
          <td><select id="post_cate" name="category">
              <option value="0" <?php echo ($post->post_category==0?'selected="selected"':''); ?> >无分类</option>
              <?php foreach($category as $row) {
                echo '<option value="'.$row->category_id.'" '.(($row->category_id==$post->post_category)?'selected="selected"':'').' >'.$row->category_name.'</option>';
              }
              ?>
            </select>
          </td></tr>
        <tr><td align="right">类型：</td><td><input type="radio" name="type" value="0" <?php echo (intval($post->post_type)==0?'checked="checked"':''); ?> />不推荐 <input type="radio" name="type" value="1" <?php echo ($post->post_type==1?'checked="checked"':''); ?> />推荐 <input type="radio" name="type" value="2" <?php echo ($post->post_type==2?'checked="checked"':''); ?> />焦点</td></tr>
        <tr><td align="right">描述：</td><td><textarea cols="50" rows="5" name="description" ><?php echo $post->post_description; ?></textarea></td></tr>
        <tr><td align="right">缩略图：</td><td><input size="50" type="hidden" name="thumb" value="<?php echo $post->post_thumb; ?>" /><?php echo $post->post_thumb; ?>&nbsp;&nbsp;选择第<input size="2" type="text" name="select_thumb"/>张图片作为封面</td></tr>
        <tr><td align="right">发布时间：</td><td><input type="text" name="date" value="<?php echo date('Y-m-d H:i:s',$post->post_date); ?>" /></td></tr>
        <tr><td align="right">点击数：</td><td><input type="text" name="hit" value="<?php echo intval($post->post_hit); ?>" /></td></tr>
        <tr><td align="right" valign="top">图片：</td><td>
            <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding:2px; line-height: 20px;">
              <span id="spanButtonPlaceholder"></span>
            </div>
            <div id="divFileProgressContainer"></div>
            <div id="thumbnails">
              <?php $i=0;
              $pictures=(trim($post->post_pictures)=='')?array():unserialize($post->post_pictures);
              foreach ( $pictures as $row ) {
                echo '<div id="thumb'.($i+1).'"><img src='.base_url().'index.php/admin/picture/thumb/'.str_replace('/', '_', $row).' /><p><input type="hidden" name="pictures[]" value="'.$row.'" /><a href="javascript:delPic('.($i+1).');">删除</a></p></div>';
                $i++;
              }
              ?>
            </div>
            <script type="text/javascript">thumbid=<?php echo $i; ?>;</script>
          </td></tr>
        <tr><td></td><td><input type="hidden" name="id" value="<?php echo $post->post_id; ?>"  /><input type="button" value="修改" class="btn" onclick="check();" /></td></tr>
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
      file_types : "*.jpg",
      file_types_description : "JPG Images",
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
<?php include 'footer.php'; ?>
