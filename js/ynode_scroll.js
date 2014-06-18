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
				           
            var tujiLength=getClassName('tuji_class').length;
			getClassName('scoll_image_mid')[0].style.marginLeft=0+'px';
			getClassName('scoll_image')[0].style.width=(tujiLength*165)+'px';
			var scale=$("scoll_line"),
					slider_knob=$("moveBut");

			var s=new Slider({
					knob:slider_knob,
					range:scale,
					mode:"H",
					onChange:function (v) {
                         if(getClassName('scroll_mid_bac')[0].offsetLeft<495||getClassName('scoll_image')[0].offsetLeft>0){
							 getClassName('scoll_image')[0].style.left=0;
						  getClassName('scroll_mid_bac')[0].style.left=((165*(tujiLength-1))/100)*v+'px';
						  var ynode_i=parseInt((getClassName('scroll_mid_bac')[0].offsetLeft)/165);
						  if((getClassName('scroll_mid_bac')[0].offsetLeft)%165==0){
						   for(var i=0;i<tujiLength;i++){
							getClassName('tuji_class')[i].style.display='none';
							}
							getClassName('tuji_class')[ynode_i].style.display='block';
							}
						 }else{
						  getClassName('scoll_image')[0].style.left=-(((165*(tujiLength-1))/100)*v-495)+'px';
						  var ynode_j=parseInt((-getClassName('scoll_image')[0].offsetLeft)/165);
						  if((-getClassName('scoll_image')[0].offsetLeft)%165==0){
						   for(var i=0;i<tujiLength;i++){
							getClassName('tuji_class')[i].style.display='none'
							}
							getClassName('tuji_class')[ynode_j+3].style.display='block';
							}
						 }
                           

					}
				});
				
			s.setValue(0);
			   
                
				$('left_but').style.visibility='hidden';
				$('scoll_left').style.visibility='hidden';
				var numCount=0;
                function right_but(){
					$('left_but').style.visibility='visible';
					$('scoll_left').style.visibility='visible';
					//
					if(getClassName('scroll_mid_bac')[0].offsetLeft<400){
					
					getClassName('scroll_mid_bac')[0].style.left=(getClassName('scroll_mid_bac')[0].offsetLeft+165)+'px';
					s.setValue((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/100));
                    }else{
					 getClassName('scoll_image')[0].style.left=(getClassName('scoll_image')[0].offsetLeft-165)+'px';
					 s.setValue(((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/100))+((-getClassName('scoll_image')[0].offsetLeft)/((165*(tujiLength-1))/100)));
					}
					numCount++;
					if(numCount==(tujiLength-1)){
						clearInterval(t);
					$('right_but').style.visibility='hidden';
                    $('scoll_right').style.visibility='hidden';
					}
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class')[i].style.display='none'
					}
				    getClassName('tuji_class')[numCount].style.display='block';
				}
				 function left_but(){
					 $('right_but').style.visibility='visible';
					 $('scoll_right').style.visibility='visible';
					 if(getClassName('scroll_mid_bac')[0].offsetLeft<400||getClassName('scoll_image')[0].offsetLeft>=0){
						// alert('bb');
					getClassName('scroll_mid_bac')[0].style.left=(getClassName('scroll_mid_bac')[0].offsetLeft-165)+'px';
					s.setValue((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/100));
                    }else{
						//alert('ss');
					 getClassName('scoll_image')[0].style.left=(getClassName('scoll_image')[0].offsetLeft+165)+'px';
					 s.setValue(((getClassName('scroll_mid_bac')[0].offsetLeft*100)/((165*(tujiLength-1))))+((-getClassName('scoll_image')[0].offsetLeft*100)/((165*(tujiLength-1)))));
					}
					numCount--;
					if(numCount==0){
					$('left_but').style.visibility='hidden';
					$('scoll_left').style.visibility='hidden';
					}
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class')[i].style.display='none'
					}
				    getClassName('tuji_class')[numCount].style.display='block';
				}
				
				$('scoll_left').onclick=function(){
					
				    $('right_but').style.visibility='visible';
					$('scoll_right').style.visibility='visible';
					if(getClassName('scroll_mid_bac')[0].offsetLeft<400||getClassName('scoll_image')[0].offsetLeft>=0){
					getClassName('scroll_mid_bac')[0].style.left=(getClassName('scroll_mid_bac')[0].offsetLeft-165)+'px';
					s.setValue((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/100));
                    }else{
					 getClassName('scoll_image')[0].style.left=(getClassName('scoll_image')[0].offsetLeft)+165+'px';
					s.setValue(((getClassName('scroll_mid_bac')[0].offsetLeft*100)/((165*(tujiLength-1))))+((-getClassName('scoll_image')[0].offsetLeft*100)/((165*(tujiLength-1)))));
					}
					numCount--;
					if(numCount==0){
					$('left_but').style.visibility='hidden';
                    $('scoll_left').style.visibility='hidden';
					}
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class')[i].style.display='none'
					}
				    getClassName('tuji_class')[numCount].style.display='block';
				}
				$('scoll_right').onclick=function(){
				    $('left_but').style.visibility='visible';
					$('scoll_left').style.visibility='visible';
					if(getClassName('scroll_mid_bac')[0].offsetLeft<400){
					getClassName('scroll_mid_bac')[0].style.left=(getClassName('scroll_mid_bac')[0].offsetLeft+165)+'px';
					s.setValue((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/100));
                    }else{
						
					 getClassName('scoll_image')[0].style.left=(getClassName('scoll_image')[0].offsetLeft-165)+'px';
					s.setValue(((getClassName('scroll_mid_bac')[0].offsetLeft)/((165*(tujiLength-1))/100))+((-getClassName('scoll_image')[0].offsetLeft)/((165*(tujiLength-1))/100)));
					}
					numCount++;
					if(numCount==(tujiLength-1)){
					$('right_but').style.visibility='hidden';
                    $('scoll_right').style.visibility='hidden';
					}
					for(var i=0;i<tujiLength;i++){
					getClassName('tuji_class')[i].style.display='none'
					}
				    getClassName('tuji_class')[numCount].style.display='block';
				}
				function addEvent(node,eventType,handler){
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
			  addEvent( $('right_but'),'click',right_but);
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
						clearInterval(tS);
					$('right_but2').style.visibility='hidden';
                    $('scoll_right2').style.visibility='hidden';
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
				  tS=setInterval(openScroll,1000);
			      $("cboxOverlay").style.display='block';
				  getClassName("container")[0].style.display='none';
                  
			  }
			  $("open_close").onclick=function(){
			      $("cboxOverlay").style.display='none';
				  getClassName("container")[0].style.display='block';
                  
			  }