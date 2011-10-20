// JavaScript Document


$(document).ready(function(){
	 $(".catablog-gallery").hover(function(){
		$(this).fadeTo("slow", 0.5); // This should set the opacity to 100% on hover
		},function(){
		$(this).fadeTo("slow", 1); // This should set the opacity back to 30% on mouseout
	});

//$(".scrollable").scrollable({circular:true, mousewheel:true}).navigator().autoscroll({autoplay:true, interval:6000});

$('.flexslider').flexslider();

});