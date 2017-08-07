<?php
	require_once(dirname(__file__) . "/../libraries/scssphp-0.6.3/scss.inc.php");
	use Leafo\ScssPhp\Server;
	$directory = dirname(__file__);
	Server::serveFrom($directory);
?>