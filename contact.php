<?php
	// handles errors in sending message
	session_start();
	if (isset($_SESSION["sendError"])) {
		if ($_SESSION["sendError"]["spam"])
			$error = "<p class=\"error\">Your message has not been sent because it was flagged as spam.</p>";
		else
			$error =  "<p class=\"error\">There was a problem sending your message.<br/>Please try again, or send an email directly to contact@rocketchilli.com.</p>";
		$name = $_SESSION["sendError"]["name"];
		$email = $_SESSION["sendError"]["email"];
		$subject = $_SESSION["sendError"]["subject"];
		$message = $_SESSION["sendError"]["message"];
		unset($_SESSION["sendError"], $_SESSION["spam"]);
	}
	
	$publicKey = rand() % 9;
	$privateKey = 0.9;
	$token = sha1($publicKey * $privateKey + $privateKey);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Rocket Chilli - Get in touch</title>
	<meta http-equiv="generator" content="Notepad++" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="Jonathan Holvey" />
	
	<?php include("resources.php"); ?>
	<script type="text/javascript" src="script/validate.js"></script>
	<script type="text/javascript" src="script/jquery.elastic.js"></script>
	<script type="text/javascript">$(document).ready(function(){$("textarea").elastic();});</script>
	<style type="text/css">#linkContact{color:#8AC730 !important}</style>
</head>
<body>
	<?php include("header.php"); ?>
	<div class="pageTitle"><img src="images/getInTouch.png" alt="Get in touch..."/></div>
	<div class="tile left"><div class="back"><div class="normal">
		<p>To contact me about any enquiries, or to request a quote for a project just fill out the form below. I will get back to you as soon as possible.</p>
		<?php if (isset($error)) echo $error ?>
		<form id="contactForm" method="post" action="send.php">
			<div class="row">
				<input type="text" name="name" <?php if(isset($name)) echo "value=\"" . $name . "\""; ?>/>
				<div class="title">Name:</div>
				<div class="prompt">&larr; Enter your name here</div>
			</div>
			<div class="row">
				<input type="text" name="email" <?php if(isset($email)) echo "value=\"" . $email . "\""; ?>/>
				<div class="title">Your email:</div>
				<div class="prompt">&larr; Enter a valid email address here</div>
			</div>
			<div class="row">
				<input type="text" name="subject" <?php if(isset($subject)) echo "value=\"" . $subject . "\""; ?>/>
				<div class="title">Subject:</div>
				<div class="prompt">&larr; Enter a subject here</div>
			</div>
			<div class="row">
				<textarea name="message" rows="" cols=""><?php if(isset($message)) echo $message; ?></textarea>
				<div class="title">Message:</div>
				<div class="prompt">&larr; Enter your message here</div>
			</div>
			<input type="text" name="publicKey" value="<?php echo $publicKey ?>" class="check"/>
			<input type="text" name="token" value="<?php echo $token ?>" class="check"/>
			<div class="button centred">Send message</div>
		</form>
	</div></div></div>
	<?php include("footer.php"); ?>
</body>
</html>