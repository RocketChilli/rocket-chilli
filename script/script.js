// stretches navigation tabs when mouseovered
$(document).ready(function(){
	$(".link").hover(
		function(){
			$(this).stop().animate({height:60},150);
		},
		function(){
			$(this).stop().animate({height:50},350);
	});
});