$(document).ready(function() {
	// drop navigation tabs on mouseover
	$("#navBar .tab").hover(
		function() {
			$(this).stop().animate({height:50},300);
		},
		function(){
			$(this).stop().animate({height:35},450,"easeOutBounce");
	});
	
	// show the "Share this page:" text on hovering over the footer
	$("#share").hover(
		function() {
			$("#share .shareTitle").show();
		},
		function() {
			$("#share .shareTitle").hide();
	});
	
	// highlight active form fields
	$("input,textarea").focus(function() {
		$(this).addClass("focused");
	});
	$("input,textarea").blur(function() {
		$(this).removeClass("focused");
	});
	
	// make entire tab and button clickable
	$("#navBar .tab,.button").click(function() {
		if ($(this).children("a").attr("href"))
			location.href = $(this).children("a").attr("href");
	});
	
	// correct scrolling of # links
	$("img").imagesLoaded(function() {
		if ($(window.location.hash).offset()) {
			var scroll = $(window.location.hash).offset().top - $("#navBar").height();
			setTimeout("scrollTo(0," + scroll + ")",100);
		}
	});
});