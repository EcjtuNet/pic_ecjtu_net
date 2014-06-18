<?php include 'header.php'; ?>
<div id="upload_main">
    <div id="upload_container">
       <h1>我添加的图集</h1>
       <div id="upload_form">
      <form id="form" name="form" action="<?php echo site_url('upload_add'); ?>" method="post" >
      <table id="table">
        <tr><td align="right" width="100">标题：</td><td><input class="post_title" size="50" type="text" name="title" value="" onfocus="this.className='bd'" onblur="this.className=''"/></td></tr>
        <tr><td align="right">作者：</td><td><input id="post_author" size="50" type="text" name="author" value="日新网友" onclick="this.value=''" onfocus="this.className='bd'" onblur="this.className=''"/></td></tr>
        <tr><td align="right">分类：</td>
          <td><select id="post_cate" name="category">
              <?php foreach($category as $row) {
                echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
              }
              ?>
            </select>
          </td></tr>
        <tr><td align="right">描述：</td><td>
        	<textarea cols="50" rows="5" id="b" name="description"></textarea>
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
            <tr><td align="right" valign="top">图片：</td><td>
                <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding:2px; line-height: 20px;">
                  <span id="spanButtonPlaceholder"></span>
                </div>
                <div id="divFileProgressContainer"></div>
                <div id="thumbnails">
                </div>
              </td></tr>
            <tr><td align="right">缩略图：</td><td><input size="50" type="hidden" name="thumb" value="" />&nbsp;&nbsp;选择第<input size="2" type="text" name="select_thumb" onfocus="this.className='bd'" onblur="this.className=''"/>张图片作为封面</td></tr>
            <tr><td></td><td><input type="button" value="" class="btn" onclick="check();" /></td></tr>
          </table>
        </form>
       </div>
    </div>
</div>
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
  var sub =false;
  function check(){
    var post_title=$('#post_title');
    var post_cate=$('#post_cate');
    var des = $('#b');
    if(post_title.val()==''){
      alert('标题不能为空');
      post_title.focus();
      return;
    }
    if(post_cate.val()==0){
      alert('请选择分类');
      post_cate.focus();
      return;
    }
    if(des.val()==''){
      alert('请添加图集描述');
      des.focus();
      return;
    }
    sub=true;
    document.form.submit();
  }
</script>
<script type="text/javascript">
window.onbeforeunload=function (){
if(sub==false)
{
	var pic = document.getElementById("thumbnails");
	var num = pic.getElementsByTagName("a").length;
	for (var i = 1; i <= num; i++)
    {
		delPic(i);
        //pic.getElementsByTagName("a")[i].onclick();
    }
	//alert("===onbeforeunload===");
}
//alert("===onbeforeunload===");
if(event.clientX>document.body.clientWidth && event.clientY < 0 || event.altKey){
	var pic = document.getElementById("thumbnails");
	//alert(pic.getElementsByTagName("a").length);
	var num = pic.getElementsByTagName("a").length;
	for (var i = 1; i <= num; i++)
    {
		delPic(i);
        //pic.getElementsByTagName("a")[i].onclick();
    }
     //alert("你关闭了浏览器");
}else{
	var pic = document.getElementById("thumbnails");
	//alert(pic.getElementsByTagName("a").length);
	var num = pic.getElementsByTagName("a").length;
	for (var i = 1; i <= num; i++)
    {
		delPic(i);
        //pic.getElementsByTagName("a")[i].onclick();
    }
    //alert("你正在刷新页面");
}
}
</script>
<?php include 'footer.php'; ?>