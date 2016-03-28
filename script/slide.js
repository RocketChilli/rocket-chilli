// open cover has z-index 1, closed 0 - used for correct stacking, and also to determine if a cover is open
// the .shadow element is a div the same size and shape as the .cover, with a shadow image along one side

var isOpen = false;
var timeOpen = 600;
var timeClose = 400;
var easeOpen = "easeOutBack";
var easeClose = "";

// function called when any .cover element is clicked
$(document).ready(function(){
	$(".cover").click(function(){
		// shows shadow and info which are hidden initially to prevent ugliness on load
		$(".cover .shadow,.tile .info").css({visibility:"visible"});
		
		var id = this.id;
		// extracts direction and distance info from array slideInfo[], which is in format eg: "-100x"
		var info = slideInfo[id.match(/\d+/)];
		var end = parseInt(info);
		var dir = info.replace(end,"");

		// opens cover if all are closed  - prevents delay caused by closing covers
		if (isOpen == false) {
			isOpen = true;
			$("#" + id).css({zIndex:1});
			open(id,dir,end);
		}
		// colses covers and shadows, and opens new cover
		else if ($("#" + id).css("zIndex") == 0) {
			$(".cover .shadow").stop().animate({bottom:0,left:0},timeClose,easeClose);
			$(".cover").stop().animate({bottom:0,left:0},timeClose,easeClose,function(){
				$(".cover").css({zIndex:0});
				$("#" + id).css({zIndex:1});
				open(id,dir,end);
			})
		}
		// closes all covers and shadows
		else {
			isOpen = false;
			$(".cover .shadow").stop().animate({bottom:0,left:0},timeClose,easeClose);
			$(".cover").stop().animate({bottom:0,left:0},timeClose,easeClose,function(){
				$(".cover").css({zIndex:0});
			})
		}
	});
});
// opens shadow and cover
function open(id,dir,end) {
	openShadow(id,dir,end);
	if (dir == "x")
		$("#" + id).stop().animate({left:end},timeOpen,easeOpen);
	else if (dir == "y")
		$("#" + id).stop().animate({bottom:end},timeOpen,easeOpen);
}
// opens shadow
function openShadow(id,dir,end) {
	shift = -10 * (end / Math.abs(end))
	if (dir == "x")
		$("#" + id + " .shadow").stop().animate({left:shift},timeOpen,easeOpen);
	else if (dir == "y")
		$("#" + id + " .shadow").stop().animate({bottom:shift},timeOpen,easeOpen);
}

