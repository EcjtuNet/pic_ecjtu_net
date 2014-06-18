<?php include 'header.php'; ?>
    <div class="mid" id="show_mid">
         <div id="show_list">
             <div id="show_lAll" class="show_m"><div id="allLog"></div><a href="index.php/all"><div class="listTxt" id="l1"></div></a></div>
             <div id="show_lFJ" class="show_m"><div id="fjLog"></div><a href="index.php/<?php echo $category[0]['category_slug']?>" <?php echo $category[0]['category_id']==$cateid?'class="current_page_item"':'';?> title="<?php echo $category[0]['category_name']?>" ><div class="listTxt" id="l2"></div></a></div>
             <div id="show_lCY" class="show_m"><div id="cyLog"></div><a href="index.php/<?php echo $category[1]['category_slug']?>" <?php echo $category[1]['category_id']==$cateid?'class="current_page_item"':'';?> title="<?php echo $category[1]['category_name']?>" ><div class="listTxt" id="l3"></div></a></div>
             <div id="show_lGS" class="show_m"><div id="gsLog"></div><a href="index.php/<?php echo $category[2]['category_slug']?>" <?php echo $category[2]['category_id']==$cateid?'class="current_page_item"':'';?> title="<?php echo $category[2]['category_name']?>" ><div class="listTxt" id="l4"></div></a></div>
             <div id="show_lQC" class="show_m"><div id="qcLog"></div><a href="index.php/<?php echo $category[3]['category_slug']?>" <?php echo $category[3]['category_id']==$cateid?'class="current_page_item"':'';?> title="<?php echo $category[3]['category_name']?>" ><div class="listTxt" id="l5"></div></a></div>
             <div id="show_lJY" class="show_m"><div id="jyLog"></div><a href="index.php/<?php echo $category[4]['category_slug']?>" <?php echo $category[4]['category_id']==$cateid?'class="current_page_item"':'';?> title="<?php echo $category[4]['category_name']?>" ><div class="listTxt" id="l6"></div></a></div>
             <div id="show_lTX" class="show_m"><div id="txLog"></div><a href="index.php/<?php echo $category[5]['category_slug']?>" <?php echo $category[5]['category_id']==$cateid?'class="current_page_item"':'';?> title="<?php echo $category[5]['category_name']?>" ><div class="listTxt" id="l7"></div></a></div>
         </div>
         <div id="show_con"><!--右侧展示-->
             <div id="show_tit"></div>
             <div id="show_logTxt">最新上传的图集</div>
             <?php foreach ($posts_pic as $rs):?>
             <a href="<?php echo site_url('pictures/'.$rs['posts_id']); ?>"><div class="show_pic" ><img width="209" height="141" src="<?php echo site_url('thumb/'.'4/'.str_replace('/','_',$rs['posts_thumb'])); ?>" alt="<?php echo $rs['posts_title']?>" title="<?php echo $rs['posts_title']?>" ><div class='posts_title'>[ 图集 ]<?php echo $rs['posts_title']?></div></div></a>
             <?php endforeach; ?>
             <div id="show_page"><?php echo $page_links; ?></div>
             
         </div>

    <script type="text/javascript">
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
	  var classLeg=getClassName('show_pic').length;
	  if((classLeg-1)%3==0)
		  {
		  getClassName('show_pic').className ='show_pic show_picF';
		  }
    </script>      
          
    </div>
<?php include 'footer.php'; ?>