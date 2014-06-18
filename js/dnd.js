(function () {
//handle是可选参数
/*
args {
	layer
	handle [layer]
	range {
		minX
		maxX
		minY
		maxY
	} /Node
	mode "H"/"V"
}
*/
function DND(args) {
	Base.init(DND,this,args);
	if (this.range.nodeType) {//假如是DOM元素时候
			var _range=this.range;
			this.range={
				valueOf:function (_this) {
					var offset=getOffset(_range),
							ml=parseInt(getRealStyle(_this.layer,"margin-left")) || 0,
							mr=parseInt(getRealStyle(_this.layer,"margin-right")) || 0,
							mt=parseInt(getRealStyle(_this.layer,"margin-top")) || 0,
							mb=parseInt(getRealStyle(_this.layer,"margin-bottom")) || 0;
					return {
						minX:offset.x,
						minY:offset.y,
						maxX:offset.x+_range.clientWidth-_this.layer.offsetWidth-ml-mr,
						maxY:offset.y+_range.clientHeight-_this.layer.offsetHeight-mt-mb
					};
				}
			};
	}
	
	
	var _this=this;
	this.enable();
	
}
DND.defaultArgs={
	handle:{
		valueOf:function (_this) {
			return _this.originalArgs.layer;
		}
	},
	range:{
		valueOf:function () {
			return document.documentElement;
		}
	},
	className:"moving"
};
//自定义事件
DND.prototype={
	startDrag:function (evt) {//开始拖动
		var ret;
		if (this.onDragStart)
			ret=this.onDragStart(evt,this);
		
		if (ret===false) {
			return false;
		}
		//evt.preventDefault();
		if(evt.preventDefault)
		{
			evt.preventDefault();	
		}
		else
		{
			window.event.returnValue = false;//如果是IE下执行这个	
		}
		
		var layerOffset=getOffset(this.layer);
		this.offset={//mousedown时鼠标与对象左上角的偏移
			x:evt.pageX-layerOffset.x,
			y:evt.pageY-layerOffset.y
		};
		
		

		addClass(this.layer,this.className);
		var _this=this;
		this.mousemoveHandle=function (evt) {
			//evt.preventDefault();
			if(evt.preventDefault)
			{
				evt.preventDefault();	
			}
			else
			{
				window.event.returnValue = false;//如果是IE下执行这个	
			}
			_this.move(evt);
		};
		this.mouseupHandle=function(evt) {
			//evt.preventDefault();
			if(evt.preventDefault)
			{
				evt.preventDefault();	
			}
			else
			{
				window.event.returnValue = false;//如果是IE下执行这个	
			}
			_this.stopDrag();
		};
		addEvent(document,"mousemove",this.mousemoveHandle);
		addEvent(document,"mouseup",this.mouseupHandle);
		addEvent(window,"blur",this.mouseupHandle);
		
		//清除文本选中状态
		if (document.selection && document.selection.empty) {
			document.selection.empty();  //IE
		}	else if (window.getSelection) {
			window.getSelection().removeAllRanges(); //火狐
		}
		

		if (this.layer.setCapture) {//IE 当鼠标移出窗口之后仍能捕获事件
			this.layer.setCapture(true);
		}
		addEvent(this.layer,"dragstart",function (evt) {
			//阻止浏览器的默认拖动行为
			//evt.preventDefault();
			if(evt.preventDefault)
			{
				evt.preventDefault();	
			}
			else
			{
				window.event.returnValue = false;//如果是IE下执行这个	
			}
		});
		
		
	},
	move:function (evt) {//计算坐标
		
		
		
		var x=evt.pageX-this.offset.x-parseInt(getRealStyle(this.layer,"margin-left")),
				y=evt.pageY-this.offset.y-parseInt(getRealStyle(this.layer,"margin-top"));
		
		
		var de=document.documentElement;
		var range=this.range.valueOf(this);
		
		x=Math.max(x,range.minX);
		x=Math.min(x,range.maxX);
		y=Math.max(y,range.minY);
		y=Math.min(y,range.maxY);
		
		
		var ret;
		if (this.onMove) 
			ret=this.onMove(evt,this,{x:x,y:y});
			
		if (ret===false)
			return false;
		
		if (this.layer.offsetParent!=de) {
			var parentPos=getOffset(this.layer.offsetParent);
		} else {
			var parentPos={x:0,y:0};
		}
		if (this.mode!="V")
			this.layer.style.left=x-parentPos.x+"px";
		
		if (this.mode!="H")
			this.layer.style.top=y-parentPos.y+"px";
		
		
	},
	stopDrag:function () {//停止拖动
		delEvent(document,"mousemove",this.mousemoveHandle);
		delEvent(document,"mouseup",this.mouseupHandle);
		delEvent(window,"blur",this.mouseupHandle);
		delClass(this.layer,this.className);
		if (this.layer.releaseCapture) {//IE 
			this.layer.releaseCapture(true);
		}
		if (this.onDrop)
			this.onDrop(this);
	},
	disable:function () {//禁用拖动
		this.stopDrag();
		delEvent(this.handle,"mousedown",this.mousedownHandle);
	},
	enable:function () {//启用拖动
		var _this=this;
		this.mousedownHandle=function (evt) {
			_this.startDrag(evt);
		};
		addEvent(this.handle,"mousedown",this.mousedownHandle);
	},
	getRange:function () {
		return this.range.valueOf(this);
	}
};


window.DND=DND;
	
	
})();