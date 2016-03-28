<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
	// load websites.xml and counts shown sites
	$xml = simplexml_load_file("websites.xml");
	$sites = 0;
	foreach ($xml as $site) {
		if ($site["show"] == "yes")
			$sites ++;
	}
?>	

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Rocket Chilli - Portfolio</title>
	<meta http-equiv="generator" content="Notepad++" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="Jonathan Holvey" />
	
	<?php include("resources.php"); ?>
	<script type="text/javascript" src="script/slide.js"></script>
	<style type="text/css">#linkWebsites{color:#8AC730 !important}</style>
</head>
<body>
	<?php include("header.php"); ?>
	<div class="pageTitle"><img src="images/websitePortfolio.png" alt="Website portfolio"/></div>
	<div class="tile left"><div class="back"><div class="normal">
		<p class="no" style="text-align:center">Here is a selection of some of the websites that have been designed and built by Rocket Chilli. Click on an image for more information about the site.</p>
	</div></div></div>
	<?php
		$left = true;
		$count = 1;
		foreach ($xml as $site) {
			// displays tiles for shown sites
			if ($site["show"] == "yes") {
				echo "<div class=\"tile website";
				// moves last tile to middle of row if on its own
				if ($count == $sites && $left == true)
					echo " middle";
				// applys style for no left margin for left hand tiles
				elseif ($left == true)
					echo " left";
				echo "\">
					<div class=\"title\">" . $site->shortTitle . " - " . $site->url . "</div>
					<div class=\"back\">
						<div class=\"info\">
							<span class=\"infoTitle\">" . $site->title . "</span><br/>
							<span class=\"role\">" . $site->role . "</span>
							<br/>" . $site->info . "<br/>
							<a href=\"http://" . $site->url . "\">" . $site->url . "</a>
						</div>
						<div class=\"cover\" id=\"cover" . $count . "\">
							<div class=\"shadow\"></div>
							<div class=\"front\" style=\"background-image:url('" . $site->image . "')\"></div>
						</div>
					</div>
				</div>";
				if ($left == true)
					$left = false;
				else
					$left = true;
				$count ++;
			}
		}
	?>
	<?php include("footer.php"); ?>
</body>
</html>