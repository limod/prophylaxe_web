jQuery(document).ready(function($) {
	
	
	$('.navbar .nav > li').hover(function(){
		$(this).children('ul.sub-menu').stop().animate({top:'100%'}, 1000, 'easeOutQuint');
	}, function(){
		$(this).children('ul.sub-menu').stop().animate({top:'70%'}, 1000, 'easeOutQuint');
	});
	
	$('.navbar .nav ul li').hover(function(){
		$(this).children('ul.sub-menu').stop().animate({opacity: 1}, 1000, 'easeOutQuint');
	}, function(){
		$(this).children('ul.sub-menu').stop().animate({opacity: 0}, 1000, 'easeOutQuint');
	});
	
	
});

