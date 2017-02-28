//侧边菜单点击事件
$(function(){
    $(".ce > li > a").click(function(){
	     $(this).addClass("xz").parents().siblings().find("a").removeClass("xz");
		 $(this).parents().siblings().find(".er").hide(300);
		 $(this).siblings(".er").toggle(300);
		 $(this).parents().siblings().find(".er > li > .thr").hide().parents().siblings().find(".thr_nr").hide();
	})
});
window.onload = function(){
	var body = document.getElementsByTagName('body')[0];
	//左上角点击事件
	var headMenu = document.getElementById("headMenu");
	var sliderBar = document.getElementById("sliderbar");
	var content_slide = document.getElementById("content_slide");
	headMenu.onclick = function(){
		sliderBar.style.left = '0px';
		var sliderBarWidth = sliderBar.offsetWidth;
		sliderBar.style.left = sliderBar.offsetLeft == 0 ? -sliderBarWidth + 'px' : 0;
		sliderBar.style.opacity = sliderBar.offsetLeft == 0 ? '0' : '1';
		content_slide.style.marginLeft = sliderBar.offsetLeft == 0 ? '10px' : sliderBar.offsetWidth + 10 + 'px';
		
	};
	//改进主体部分
	window.onresize = function(){
		setTimeout(function(){
			content_slide.style.marginLeft = sliderBar.offsetLeft < 0 ? '0px' : sliderBar.offsetWidth + 10 + 'px';
		},500)
	}
	

};

