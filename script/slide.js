$(document).ready(function() {
	// opens cover when element .cover is clicked
	// open cover has z-index 1, closed 0 - used for correct stacking, and also to determine if a cover is open
	
	$(".tile .cover .front").click(function() {
		var tile = "#" + $(this).parent().attr("id");		
		var timeOpen = 600;
		var timeClose = 600;
		var easeOpen = "easeOutBack";
		var easeClose = "easeOutBounce";
		var distance = Math.round($(tile).height() * 0.6);
		
		// checks for open covers
		var open = false;
		$(".tile .front").each(function() {
			if (parseInt($(this).css("zIndex")) != 0)
				open = "#" + $(this).parent().attr("id");
		});
		
		// closes clicked cover if matched with open cover
		if (open == tile) {
			$(".tile .shadow,.tile .cover").stop().animate({top:0},timeClose,easeClose,function() {
				$(".tile .front").css({zIndex:0});
			});
		}
		// opens clicked cover when all are closed
		else if (open == false)
			openCover(tile,timeOpen,easeOpen)
		// opens clicked cover after closing previously open covers
		else {
			$(".tile .shadow,.tile .cover").stop().animate({top:0},timeClose,easeClose,function() {
				$(".tile .front").css({zIndex:0});
				openCover(tile,timeOpen,easeOpen)
			});
		}
		
		// code for opening cover
		function openCover() {
			$(tile + " .front").css({zIndex:1});
			$(tile).stop().animate({top:distance},timeOpen,easeOpen);
			$(tile + " .shadow").stop().animate({top:-10},timeOpen,easeOpen);
		}
	});
});