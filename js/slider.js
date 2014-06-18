(function () {
	
/**
args {
	knob Node	拖动手柄
	range	Node	限制范围
	values [start,end] 值的范围
	mode "H"/"V"	水平拖动还是垂直拖动
}
*/
function Slider(args) {
	Base.init(Slider,this,args);
	
	this.valueLength=this.values[1]-this.values[0];//值的变化
	
	var $this=this;
	
	this.modeAttrs=this.mode=="H"?{
		raMax:"maxX",
		raMin:"minX",
		css:"left"
	}:{
		raMax:"maxY",
		raMin:"minY",
		css:"top"
	};
	
	this.DNDInstance=new DND({
		layer:this.knob,
		range:this.range,
		mode:this.mode,
		onMove:function (evt,dnd) {
			var far=parseInt(getRealStyle($this.knob,$this.modeAttrs.css)) || 0,
					range=dnd.getRange(),
					rangeLength=range[$this.modeAttrs.raMax]-range[$this.modeAttrs.raMin],
					percent=far/rangeLength,
					value=parseInt(percent*$this.valueLength)+$this.values[0];
					
					
			
			$this.value=value;
			if ($this.onChange)
				$this.onChange(value,$this);
		}
	});
}

Slider.defaultArgs ={
	values:[0,1000],
	mode:"H"
};
Slider.prototype={
	getValue:function () {
		return this.value;
	},
	setValue:function (v) {
		var percent=(v-this.values[0])/this.valueLength,
				range=this.DNDInstance.getRange(),
				rangeLength=range[this.modeAttrs.raMax]-range[this.modeAttrs.raMin],
				pos=percent*rangeLength;
				
				
		this.knob.style[this.modeAttrs.css]=pos+"px";
		
		
		if (this.onChange)
			this.onChange(v);
	}
};

window.Slider=Slider;


})();