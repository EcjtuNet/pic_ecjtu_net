// JavaScript Document
/*(function(){
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
       function setOpacity(node,level){
	     node=$(node);
		 if(document.all){
		   node.style.filter='alpha(opacity='+level+')';
		 }else{
		   node.style.opacity=level/100;
		 }
	   }
		   
		   var Tween={
		     Quad:{//二次方缓动
				easeIn:function (start,alter,curTime,dur) {
					return start+Math.pow(curTime/dur,2)*alter;
				},
				easeOut:function (start,alter,curTime,dur) {
					var progress =curTime/dur;
					return start-(Math.pow(progress,2)-2*progress)*alter;
				},
				easeInOut:function (start,alter,curTime,dur) {
					var progress =curTime/dur*2;
					return (progress<1?Math.pow(progress,2):-((--progress)*(progress-2) - 1))*alter/2+start;
				},
				easedown:function(start,alter,curTime,dur){
					var progress =curTime/dur*2;
					return (progress<1?-Math.pow(progress,2):+((--progress)*(progress-2) - 1))*alter/2+start;
					}
	         }
		   }

		
		function animate(o,start,alter,dur,fx) {
	var curTime=0;
	var t=setInterval(function () {
		if (curTime>=dur) clearInterval(t);
		for (var i in start) {
			o.style[i]=fx(start[i],alter[i],curTime,dur)+"px";
		}
		curTime+=40;
		
	},40);
	return function () {
			clearInterval(t);
	};
}




function Player(buttons,scrollContent,imageWidth,hoverClass,timeout) {
			hoverClass=hoverClass || 'hover';
			timeout=timeout || 3000;
			this.buttons=buttons;
			this.scrollContent=scrollContent;
			this.hoverClass=hoverClass;
			this.timeout=timeout;
			this.imageWidth=imageWidth;
			this.curItem=buttons[0];
			var _this=this;
			for (var i=0;i<this.buttons.length;i++) {
				this.buttons[i].onmouseover=function () {
					_this.stop();
					_this.invoke(this.index);
				};
				this.buttons[i].onmouseout=function () {
					_this.start();
				};
				this.buttons[i].index=i;
			}
			this.invoke(0);
		}

Player.prototype={
	start:function () {
		var _this=this;
		this.stop();
		this.interval=setInterval(function () {
			_this.next();
		},this.timeout);
	},
	stop:function () {
		clearInterval(this.interval);
	},
	invoke:function (n) {//具体显示哪一帧
		
		this.curItem=this.buttons[n];
		var content=getClassName('ynode-content');
		for(var i=0;i<content.length;i++){
		  content[i].style.display='none';
		}
		content[n].style.display='block';
		
		//this.scrollContent.style.top=-n*this.imageHeight+"px";
		var left=parseInt(this.scrollContent.style.left) || 0;
		//this.scrollContent.style.left=-n*712+'px';
		this.animateIterval && this.animateIterval();
		this.animateIterval=animate(this.scrollContent,{
			left:left
		},{left:(-n*this.imageWidth)-left},1000,Tween.Quad.easeInOut);
		
		//先将所有按钮样式恢复
		this.recoverButtonsClass();
		this.curItem.style.background='white';
		//this.curItem.className=this.hoverClass;
		
		
	},
	next:function () {
		//this.curItem.index//curItem当前的那一帧
		var nextIndex=this.curItem.index+1;
		if (nextIndex>=this.buttons.length) {
			nextIndex=0;
		}
		this.invoke(nextIndex);
	},
	recoverButtonsClass:function () {//将所有按钮样式恢复
		for (var i=0;i<this.buttons.length;i++) {
			this.buttons[i].style.background='#b3b3b3';
		}
	}
};


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
	 function mouseout(){ 
		    window.clearInterval(t);
		    st=window.setInterval(function () {
		   var height=$('ynode-image-title').offsetHeight;
		   if(height>=71){
		    $('ynode-image-title').style.height=0-3+height+'px';
		   }else{
			 window.clearInterval(st); 
			 return;   
		   }
			},1)
		}
	 function mouseover(){ 
		   window.clearInterval(st);
           t=window.setInterval(function () {
		   var height=$('ynode-image-title').offsetHeight;
		   	if(height>=140)
			{window.clearInterval(t);return;}	
		    $('ynode-image-title').style.height=0+3+height+'px';	   
			},1);
	   }
        var t,st;
		//if($('ynode-image-title').offsetHeight>140){window.clearInterval(t);}
		//else if($('ynode-image-title').offsetHeight<71){window.clearInterval(st);}
        //addEvent( $('ynode-image-title'),'mouseover',mouseover);
	    //addEvent( $('ynode-image-title'),'mouseout',mouseout);
		var btns=getClassName('ynode-ul')[0].getElementsByTagName('li');
		var scrollContent=getClassName('ynode-scrollImg')[0];
		var player=new Player(btns,scrollContent,860,'hover',5000);
		alert("ss");
		player.start();//开始播放
		//setOpacity('ynode-image-title',70);
	


		   
	})();*/