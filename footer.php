	</div> <!-- close content div -->
	<div id="footer">
		<div id="share">
			<?php
				$url = "http://www.rocketchilli.com";
				$title = "Rocket Chilli Web Design";
			?>
			<div class="shareTitle">Share this page:</div>
			<a href="http://del.icio.us/post?url=<?php echo urlencode($url) . "&amp;title=" . urlencode($title); ?>" title="Share via Delicious"><img src="images/delicious.png" alt="Delicious"/></a>
			<a href="mailto:?subject=You might like this... <?php echo $title . "&amp;body=" . $title . "%0A" . $url; ?>" title="Share via email"><img src="images/email.png" alt="Email"/></a>
			<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($url) . "&amp;t=" . urlencode($title); ?>" title="Share via Facebook"><img src="images/facebook.png" alt="Facebook"/></a>
			<a  href="http://www.stumbleupon.com/submit?url=<?php echo urlencode($url) . "&amp;title=" . urlencode($title); ?>" title="Share via Stumbleupon"><img src="images/stumbleupon.png" alt="Stumbleupon"/></a>
			<a href="http://twitter.com/home?status=<?php echo urlencode($title . " - " . $url); ?>" title="Share via Twitter"><img src="images/twitter.png" alt="Twitter"/></a>
		</div>
		&copy; Copyright <?php echo date("Y") ?> Rocket Chilli Web Design - All rights reserved
	</div>
</div> <!-- close container div -->

<!-- google analytics tracking code -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17462091-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>