<?php
	// cancel message send and return to form
	function noSend($safe) {
		session_start();
		$_SESSION["sendError"]["name"] = $_POST["name"];
		$_SESSION["sendError"]["email"] = $_POST["email"];
		$_SESSION["sendError"]["subject"] = $_POST["subject"];
		$_SESSION["sendError"]["message"] = $_POST["message"];
		if (!$safe)
			$_SESSION["sendError"]["spam"] = true;
		header("location: contact.php");
		exit();
	}

	if (!isset($_POST["name"]) or $_POST["name"] == "" or $_POST["email"] == "" or $_POST["subject"] == "" or $_POST["message"] == "") {
		header("location: contact.php");
		exit();
	}

	// spam protection
	$publicKey = $_POST["publicKey"];
	$privateKey = 0.9;
	$token = sha1($publicKey * $privateKey + $privateKey);
	if ($token != $_POST["token"])
		noSend(false);

	// check for html in message body
	if (preg_match("/<.+?>/", $_POST["message"]) === 1)
		noSend(false);

	$name = stripslashes($_POST["name"]);
	$email = $_POST["email"];
	$subject = stripslashes($_POST["subject"]);
	$message = stripslashes($_POST["message"]);
	
	$to = "contact@rocketchilli.com";
	$headers = "From: " . $name . " (via rocketchilli.com) <" . $email . ">";
	
	if (!mail($to, $subject, $message, $headers))
		noSend(true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Rocket Chilli - Message sent</title>
	<meta http-equiv="generator" content="Notepad++" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="Jonathan Holvey" />
	
	<?php include("resources.php"); ?>
	<style type="text/css">#linkContact{color:#8AC730 !important}</style>
</head>
<body>
	<?php include("header.php"); ?>
	<div class="pageTitle"><img src="images/thankYou.png" alt="Thank you"/></div>
	<div class="tile left"><div class="back"><div class="normal">
		<p>Thank you, your message has been sent successfully. I will try to respond as soon as possible.</p>
		<div class="button centred" onclick="location.href='index.php'">Go to home page</div>
	</div></div></div>
	<?php include("footer.php"); ?>
</body>
</html>