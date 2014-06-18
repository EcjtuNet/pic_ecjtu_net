var now=0;
var pre=0;
$(document).ready(function(){
  	slider();
	setInterval("slider()",5000);
});

function showslider(id){
    now=id;
    slider();
}
function slider(){
    nxt=now < $(".focuspic").children().length-1?now+1:0;
    var nav=$(".focusnav").children();
    nav.removeClass("cur");
    nav.eq(now).addClass("cur");
    var div=$(".focuspic").children();
    div.eq(pre).fadeOut(0,function(){
        pre=now;
        div.css('z-index',1);
        div.eq(now).css("z-index",6).fadeIn(600);
        //div.eq(pre).css("z-index",4);
        //div.eq(now).css("z-index",5);
        now=nxt;
    });
}