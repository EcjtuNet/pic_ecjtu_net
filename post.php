<?php include 'header.php'; ?>
  <script type="text/javascript" src="js/base.js"></script>
  <script type="text/javascript" src="js/dnd.js"></script>
  <script type="text/javascript" src="js/slider.js"></script>
  <script type="text/javascript" src="http://localhost/tuku/js/jquery-1.7.2.js"></script>
  <script type="text/javascript" src="js/jqScroll.js"></script>
  <script type="text/javascript">
if (!Array.prototype.forEach) {  
    Array.prototype.forEach = function(callback, thisArg) {  
        var T, k;  
        if (this == null) {  
            throw new TypeError(" this is null or not defined");  
        }  
        var O = Object(this);  
        var len = O.length >>> 0; // Hack to convert O.length to a UInt32  
        if ({}.toString.call(callback) != "[object Function]") {  
            throw new TypeError(callback + " is not a function");  
        }  
        if (thisArg) {  
            T = thisArg;  
        }  
        k = 0;  
        while (k < len) {  
            var kValue;  
            if (k in O) {  
                kValue = O[k];  
                callback.call(T, kValue, k, O);  
            }  
            k++;  
        }  
    };  
}  
  </script>
  <script type="text/javascript">
jQuery(document).ready(function() {
	
//    jQuery.scrollTo('#list',2000);
});
 	

  </script>
  <script type="text/javascript">
  size=new Array()
  var len=<?php echo count($size); ?>;
  for(var i=0;i<len;i++)
  {
	size[i]=new Array();
	for(var j;j<3;j++)
		{
			size[i][j]='';
		}
  }
  <?php 
	
	foreach($size as $k=>$v)
		{
			$detail[$k]=strlen($detail[$k])?$detail[$k]:'交大日新';
			echo 'size['.$k.'][0]='.$v[0].";\n";
			echo 'size['.$k.'][1]='.$v[1].";\n";
			echo 'size['.$k.'][2]="'.$detail[$k]."\";\n";
		}
  ?>
  function resize(size_a)
  {
		var tuji_show=document.getElementById('tuji_show');
		tuji_show.style.width=size_a[0]+'px';
		tuji_show.style.height=size_a[1]+'px';
		tuji_show.style.marginLeft=(395-(size_a[0]/2))+'px';
		tuji_show.style.marginRight=(395-(size_a[0]/2))+'px';
		var tuji_show_containner=document.getElementById('tuji_show_containner');
		tuji_show_containner.style.width=size_a[0]+'px';
		tuji_show_containner.style.height=size_a[1]+'px';
		var tuji_intro=document.getElementById('tuji_intro');
		tuji_intro.firstChild.innerHTML=size_a[2];
	/*if(width<700)
	{
		//$('#tuji_show').css({'width':'550px','height':'720px'});
		var tuji_show=document.getElementById('tuji_show');
		tuji_show.style.width='550px';
		tuji_show.style.height='720px';
		tuji_show.style.marginLeft='120px';
		tuji_show.style.marginRight='120px';
		//$('#tuji_show_containner').css({'width':'550px','height':'720px'});
		var tuji_show_containner=document.getElementById('tuji_show_containner');
		tuji_show_containner.style.width='550px';
		tuji_show_containner.style.height='720px';
		//$('#left_but').css('margin-left','130px');
		//document.getElementById('left_but').style.marginLeft='130px';		
	}
	else
	{
		//$('#tuji_show').css({'width':'720px','height':'550px'});
		//$('#tuji_show_containner').css({'width':'720px','height':'550px'});
		//$('#left_but').css('margin-left','35px');
		//$('#tuji_show').css({'width':'550px','height':'720px'});
		var tuji_show=document.getElementById('tuji_show');
		tuji_show.style.width='720px';
		tuji_show.style.height='550px';
		tuji_show.style.marginLeft='35px';
		tuji_show.style.marginRight='35px';
		//$('#tuji_show_containner').css({'width':'550px','height':'720px'});
		var tuji_show_containner=document.getElementById('tuji_show_containner');
		tuji_show_containner.style.width='720px';
		tuji_show_containner.style.height='550px';
		//$('#left_but').css('margin-left','130px');
		//document.getElementById('left_but').style.marginLeft='35px';	
	}*/
  }
  
  </script>
    <div style="margin: 17px auto 24px auto;" class="mid">
          <div id="list">
               <p id="list_p">当前位置:<a href="http://www.ecjtu.net">日新网</a>>><a href="<? echo site_url(); ?>">日新图说</a>>><a href="<? echo base_url(); ?>index.php/list">图集列表</a>>>图集</p>
          </div>
          <div id="list_title"><p><?php echo $posts['0']['posts_title']; ?></p></div>
          <div id="list_detali"><p>   作者：<span id="list_detali_author"><?php echo $posts['0']['posts_author']; ?></span>  发布时间：<span id="list_detali_date"><?php echo date('Y-m-d',$posts['0']['posts_pubdate'])?></span>   浏览量：<span id="list_detali_Views"><?php echo $posts['0']['posts_hit']; ?></span></p></div>
          <div id="list_fun">
              <div id="list_fun_one"></div>
              <div class="hand" id="list_fun_full"><div><img src="images/icon_fullscreen.gif" /></div><div>全屏播放</div></div><div id="list_l">|</div>
              <div class="hand" id="list_fun_suspend"><div><img id="imageStart" src="images/icon_suspend.gif" /></div><div id="imageStartTxt">幻灯播放</div></div><div id="list_l">|</div>
              <a href='<?php echo current_url(); ?>#admin_comments'><div id="list_fun_skim"><div><img src="images/icon_skim.gif" /></div><div>我要评论</div></div></a>
              <div class="hand" id="list_fun_pro"><span>提示:支持键盘翻页←左右→</span></div>
              <div class="hand" id="list_fun_ret"><span><a style="color:#bdbdbd;" href="<?php echo base_url()."index.php/list" ?>">返回图集列表</a></span></div>
          </div>
          <div id="tuji">
            <div id="left_but"><a href="javascript:;"></a></div>
            <div id="tuji_show">
			<div id="tuji_show_containner">
			<div id="area_left" style="position:absolute;width:50%;height:100%;cursor:pointer; z-index:10"></div>
			<div id="area_right" style="position:absolute;width:50%;height:100%;right:0;cursor:pointer; z-index:10;"></div>
			<?php foreach ($pictures as $rs):?>
			    <img src="<?php echo base_url($rs);//site_url('thumb/'.'1/'.str_replace('/','_',$rs)); ?>" class="tuji_class" />
			<?php endforeach; ?> 
			</div>
			</div>
            <div id="right_but"><a href="javascript:;"></a></div>
			
            <div id="tuji_intro"><p><?php echo $description; ?></p></div>
            <div id="scoll">
               <div id="scoll_left">
                   <img src="images/next_press.gif" />
               </div>
               <div id="scoll_mid">
			       <div class="scroll_mid_bac"></div>
                   <div class="scoll_image">
                   <?php foreach ($pictures as $rs):?>
					   <div class="scoll_image_mid"><img src="<?php echo site_url('thumb/'.'2/'.str_replace('/','_',$rs)); ?>" style="width:148px;height:98px;margin:18px auto auto 1px;" /></div>
				   <?php endforeach; ?> 
				   <?php  
						//$size=getimagesize(site_url($rs));
						//print_r($size);
				   ?>
				   </div>
               </div>
               <div id="scoll_right">
                   <img src="images/next_press_r.gif" />
               </div>
               <div id="scoll_line"><div id="point_left"></div><div id="line"></div><div id="point_right"></div>
			   <div id="moveBut"><img src="images/sLeft.gif" /><div class="moveLen"></div><img src="images/sMiddle.gif" /><div class="moveLen"></div><img src="images/sRight.gif" /></div>
			   </div>
			   <script type="text/javascript">
            var tujiLength=getClassName('tuji_class').length;
			count=tujiLength;
			numCount=0;
			start=1;
			getClassName('scoll_image_mid')[0].style.marginLeft='0px';
			getClassName('scoll_image')[0].style.width=(tujiLength*165)+'px';
			lin=1000;//滑条精确度
			var scale=$("scoll_line"),
					slider_knob=$("moveBut");

			var s=new Slider({
					knob:slider_knob,
					range:scale,
					mode:"H",
					onChange:function (v) {
                         if(getClassName('scroll_mid_bac')[0].offsetLeft<495||getClassName('scoll_image')[0].offsetLeft>0){
							 
							 getClassName('scoll_image')[0].style.left=0;
						  getClassName('scroll_mid_bac')[0].style.left=((165*(tujiLength-1))/lin)*v+'px';
						 //console.log('scroll_mid_bac')[0].style.left+"辅导费"); 
						  var ynode_i=parseInt((getClassName('scroll_mid_bac')[0].offsetLeft)/165);
						  //if((getClassName('scroll_mid_bac')[0].offsetLeft)%165==0){
						   for(var i=0;i<tujiLength;i++){
							getClassName('tuji_class')[i].style.display='none';
							}
							getClassName('tuji_class')[ynode_i].style.display='block';
							start=ynode_i+1;
							numCount=ynode_i
							if(ynode_i==0)
							{start=1}
							if(ynode_i==(tujiLength-1))
							{start=count}
							resize(size[ynode_i]);//调整长宽比
						//	console.log('ynode_i:'+ynode_i);
							//}
						 }else{
							
						  getClassName('scoll_image')[0].style.left=-(((165*(tujiLength-1))/lin)*v-495)+'px';
						 
						  var ynode_j=parseInt((-getClassName('scoll_image')[0].offsetLeft)/165);
						  //if((-getClassName('scoll_image')[0].offsetLeft)%165==0){
						   for(var i=0;i<tujiLength;i++){
							getClassName('tuji_class')[i].style.display='none'
							}
							getClassName('tuji_class')[ynode_j+3].style.display='block';
							
							start=ynode_j+4;
							numCount=ynode_j+3
							if(ynode_j+3==(tujiLength-1))
							{start=count}
							//}//console.log(parseInt((-getClassName('scoll_image')[0].offsetLeft)/165));
						//	console.log(ynode_j);
							resize(size[ynode_j+3]);
						 }
                      //     console.log('start:'+start)
			//			   console.log('numCount:'+numCount)
							
					}
				});//console.log(parseInt('num',getClassName('scoll_image_mid')));
			//console.log(tujiLength);
			s.setValue(0);
			   function $(id){
					return document.getElementById(id);
				  }
			   function getClassName(classN){
					if(document.getElementsByClass){
						return document.getElementsByClass(classN);
						}
						var ret=[];
						var nodes=document.getElementsByTagName('*');
						for(var i=0,len=nodes.length;i<len;i++){
							var names=nodes[i].className.split(/\s+/);
							for(var j=0,lenN=names.length;j<lenN;j++){
								  if(names[j]==classN){
									  ret.push(nodes[i]);
									  }
								}  
							}
						return ret;
				   }
				
                
				//$('left_but').style.visibility='hidden';
				//$('scoll_left').style.visibility='hidden';
			//var images=getClassName('scoll_image_mid');
			/*var images=getClassName('scoll_image_mid');
			console.log(images);
			images.forEach(function(e,index)
			{
				e.onclick=function(){images_change(index);}
			})*/

                function right_but(){
				
					if(start+1>count)
					{
						alert('已经到最后一张！');
						clearInterval(t);
						return;
					}
					
					start++;numCount++;
			//		console.log(numCount);
					resize(size[start-1]);
					$('left_but').style.visibility='visible';
					$('scoll_left').style.visibility='visible';
					//
					if(getClassName('scroll_mid_bac')[0].offsetLeft<400){
					
					getClassName('scroll_mid_bac')[0].style.left=(getClassName('scroll_mid_bac')[0].offsetLeft+165)+'px';
					s.setValue((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/lin));
                    }else{
					 getClassName('scoll_image')[0].style.left=(getClassName('scoll_image')[0].offsetLeft-165)+'px';
					 s.setValue(((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/lin))+((-getClassName('scoll_image')[0].offsetLeft)/((165*(tujiLength-1))/lin)));
					}
					
					
					if(numCount==(tujiLength-1)){
						clearInterval(t);
					//$('right_but').style.visibility='hidden';
                    			//$('scoll_right').style.visibility='hidden';
					}
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class')[i].style.display='none'
					}
				    getClassName('tuji_class')[numCount].style.display='block';
					
				}
				 function left_but(){
				 
				 if(start-1==0)
					{
						return;
					}
					
					start--;numCount--;
					resize(size[start-1]);
					 $('right_but').style.visibility='visible';
					 $('scoll_right').style.visibility='visible';
					 if(getClassName('scroll_mid_bac')[0].offsetLeft<400||getClassName('scoll_image')[0].offsetLeft>=0){
						// alert('bb');
					getClassName('scroll_mid_bac')[0].style.left=(getClassName('scroll_mid_bac')[0].offsetLeft-165)+'px';
					s.setValue((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/lin));
                    }else{
						//alert('ss');
					 getClassName('scoll_image')[0].style.left=(getClassName('scoll_image')[0].offsetLeft+165)+'px';
					 s.setValue(((getClassName('scroll_mid_bac')[0].offsetLeft*lin)/((165*(tujiLength-1))))+((-getClassName('scoll_image')[0].offsetLeft*lin)/((165*(tujiLength-1)))));
					}
					
					
					if(numCount==0){
					//$('left_but').style.visibility='hidden';
					//$('scoll_left').style.visibility='hidden';
					}
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class')[i].style.display='none'
					}
				    getClassName('tuji_class')[numCount].style.display='block';
				}
				$('area_left').onclick=function(){left_but()};
				$('scoll_left').onclick=function(){
					if(start-1==0)
					{
						return;
					}
					start++;numCount--;
				    $('right_but').style.visibility='visible';
					$('scoll_right').style.visibility='visible';
					if(getClassName('scroll_mid_bac')[0].offsetLeft<400||getClassName('scoll_image')[0].offsetLeft>=0){
					getClassName('scroll_mid_bac')[0].style.left=(getClassName('scroll_mid_bac')[0].offsetLeft-165)+'px';
					s.setValue((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/lin));
                    }else{
					 getClassName('scoll_image')[0].style.left=(getClassName('scoll_image')[0].offsetLeft)+165+'px';
					s.setValue(((getClassName('scroll_mid_bac')[0].offsetLeft*lin)/((165*(tujiLength-1))))+((-getClassName('scoll_image')[0].offsetLeft*lin)/((165*(tujiLength-1)))));
					}
					
					if(numCount==0){
					//$('left_but').style.visibility='hidden';
                    //$('scoll_left').style.visibility='hidden';
					}
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class')[i].style.display='none'
					}
				    getClassName('tuji_class')[numCount].style.display='block';
				}
				$('area_right').onclick=function(){right_but()};
				$('scoll_right').onclick=function(){
					if(start+1>count)
					{
						alert('已经到最后一张！');
						return;
					}
					start++;numCount++;
				    $('left_but').style.visibility='visible';
					$('scoll_left').style.visibility='visible';
					if(getClassName('scroll_mid_bac')[0].offsetLeft<400){
					getClassName('scroll_mid_bac')[0].style.left=(getClassName('scroll_mid_bac')[0].offsetLeft+165)+'px';
					s.setValue((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/lin));
                    }else{
						
					 getClassName('scoll_image')[0].style.left=(getClassName('scoll_image')[0].offsetLeft-165)+'px';
					s.setValue(((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/lin))+((-getClassName('scoll_image')[0].offsetLeft)/((165*(tujiLength-1))/lin)));
					}
					
					if(numCount==(tujiLength-1)){
					//$('right_but').style.visibility='hidden';
                    			//$('scoll_right').style.visibility='hidden';
					}
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class')[i].style.display='none'
					}
				    getClassName('tuji_class')[numCount].style.display='block';
				}
				/*function addEvent(node,eventType,handler){
					 if(document.all){
					  node.attachEvent('on'+eventType,handler);
					 }else{
					   node.addEventListener(eventType,handler,false);
					 }
				   
				 }
				 function deleteEvent(node,eventType,handler){
					 if(document.all){
					  node.detachEvent('on'+eventType,handler);
					 }else{
					   node.removeEventListener(eventType,handler,false);
					 }
				   
				 }
			  addEvent( $('left_but'),'click',left_but);
			  addEvent( $('right_but'),'click',right_but);*/
			  $('left_but').onclick=function(){left_but()};
			  $('right_but').onclick=function(){right_but()};
			  
			  
			 
			  var t;
              $('list_fun_suspend').onclick=function(){
				if($('imageStartTxt').value=="幻灯播放"){
				$('imageStart').src="images/icon_stop.gif";
				$('imageStartTxt').value="停止播放";
				t=setInterval(right_but,1000);
				
				}
				else{
                $('imageStart').src="images/icon_suspend.gif";
				$('imageStartTxt').value="幻灯播放";
				clearInterval(t);
                
				}
			  }
			  var openScrollNum=0,tS;
			  function openScroll(){
			      $('left_but2').style.visibility='visible';
					openScrollNum++;
					if(openScrollNum==(tujiLength-1)){
						//clearInterval(tS);
					$('right_but2').style.visibility='hidden';
					}
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class2')[i].style.display='none'
					}
				    getClassName('tuji_class2')[openScrollNum].style.display='block';
			  }
			   function left_but2(){
					 $('right_but2').style.visibility='visible';
					 openScrollNum--;
					if(openScrollNum==0){
					$('left_but2').style.visibility='hidden';
					}
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class2')[i].style.display='none'
					}
				    getClassName('tuji_class2')[openScrollNum].style.display='block';
				}
				addEvent( $('left_but2'),'click',left_but2);
				addEvent( $('right_but2'),'click',openScroll);
			  $("list_fun_full").onclick=function(){
				  //tS=setInterval(openScroll,1000);
				openScroll();
			      $("cboxOverlay").style.display='block';
				  getClassName("container")[0].style.display='none';
                  
			  }
			  $("open_close").onclick=function(){
			      $("cboxOverlay").style.display='none';
				  getClassName("container")[0].style.display='block';
                  
			  }
			var images=getClassName('scoll_image_mid');
			console.log(images);
			images.forEach(function(e,index)
			{
				e.onclick=function(){images_change(index);}
			})
                function images_change(ind){
				
				//console.log(ind);	
					start=ind+1;numCount=ind;
					console.log(start+':'+numCount+':'+ind);
					resize(size[ind]);
					$('left_but').style.visibility='visible';
					$('scoll_left').style.visibility='visible';
					//
				//	if(getClassName('scroll_mid_bac')[0].offsetLeft<400){
					if(ind<3){						
					getClassName('scroll_mid_bac')[0].style.left=(ind*165+parseInt(getClassName('scoll_image')[0].style.left))+'px';
					s.setValue((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/lin));
                    			}
		    			else{
					 getClassName('scoll_image')[0].style.left=(-(165*(ind-3)))+'px';
					 s.setValue(((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/lin))+((-getClassName('scoll_image')[0].offsetLeft)/((165*(tujiLength-1))/lin)));
					getClassName('scroll_mid_bac')[0].style.left=(3*165)+'px';
					}
					
					
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class')[i].style.display='none'
					}
				    getClassName('tuji_class')[ind].style.display='block';
			 } 
			</script>


  
            </div>
            <div id="scoll_liu">
               <div id="scoll_liuImg" class="liuImg"><img src="images/says.gif" /></div>
               <div id="scoll_liuDott"></div>
               <?php foreach ($comments as $rs):?>
               <div class="scoll_liuContainer"><!--留言一-->
                  <div class="scoll_liuTit"><span class="liuName"><?php echo $rs['comments_author'];?></span><span class="liuDate"><?php echo date('Y-m-d h:i:s',$rs['comments_time']);?></span></div>
                  <div class="scoll_liuR"><?php echo $rs['comments_text']; ?></div>
                  <div class="scoll_liuX"></div>
               </div>
               <?php endforeach; ?>
              <div class="pagelink"></div>
               <form action="<?php echo site_url('comments_insert')?>" method="post" name="commentform" id="admin_comments" >
               <input type="text" name="author" maxlength="49" value="日新网友" class="admin_name"  id="admin_name" onfocus="value='';">
          
               <div id="txt" style="margin-top: 5px;"><textarea name="text" id="admin_content" onfocus="value='';">来说一点什么吧！</textarea></div>
               <input type="hidden" name="comments_posts_id" value="<?php echo $posts['0']['posts_id']; ?>" size="10" tabindex="1"/>
			   <input type="hidden" name="captcha_check" id="captcha_check" value="">
               <div id="liu_return"><div id="liu_tishi">按Ctrl+Enter快速回复</div><div id="liu_but"><input type="submit" value="发表留言" /></div></div>
       
               </form>
               <script>
					
					 
		               function keyDown(event){
		            	   var admin_comments = document.getElementById('admin_comments');
							event = event?event:window.event;
							event.target?event.target:event.srcElement;
							if(event.ctrlKey && event.keyCode==13){
								admin_comments.click();
							}
		               }
		               document.onkeydown = keyDown;
		               function keyDownL(event){
							event = event?event:window.event;
							event.target?event.target:event.srcElement;
							if(numCount==0){}else{
							if(event.keyCode==37){
								$('left_but').click();
							}
							}
					alert('left');
		              }
		              document.onkeydown = keyDownL;
		             
		               function keyDownR(event){
							event = event?event:window.event;
							event.target?event.target:event.srcElement;
							if(numCount==(tujiLength-1)){}else{
							if(event.keyCode==39){
								$('right_but').click();
							}
							}
								if(numCount==0){}else{
							if(event.keyCode==37){
								$('left_but').click();
							}
					}	
		              }
		              document.onkeydown = keyDownR;
			 </script>
               <div id="liu_space"></div>
            </div>
          </div>
          
    </div>

<?php include 'footer.php'; ?>
