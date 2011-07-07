<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php
		if (isset($page_title))
			echo $page_title . ' | ';
	?>Subrise Games</title>
	<meta name="description" content="Subrise Games Time Management System">
	<meta name="author" content="Sammy Hubner">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/assets/img/favicon.ico">
	<link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">

	<link rel="stylesheet" href="/assets/css/style.css?v=2">
	<script src="/assets/js/libs/modernizr-1.7.min.js"></script>

</head>

<body class="content">
	<?php if (isset($error_feedback)):?>
		<div class="errorFeedback">
			<div class="wrapper">
				<p><?php echo $error_feedback ?></p>
			</div><!-- .wrapper -->
		</div><!-- .errorFeedback -->
	<?php endif; ?>
	
	<div class="wrapper">
		<h1>Login</h1>
		
		<form method="post" accept-charset="utf-8">
			<p>
				<label for="txtUsername">Username</label>
				<input type="text" name="username" value="" id="txtUsername">
			</p>

			<p>
				<label for="txtPassword">Password</label>
				<input type="password" name="password" value="" id="txtPassword">
			</p>

			<p><input class="submit" type="submit" value="Login &rarr;"></p>
		</form>
	</div><!-- .wrapper -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
	<script>window.jQuery || document.write("<script src='/assets/js/libs/jquery-1.5.1.min.js'>\x3C/script>")</script>


	<!-- scripts concatenated and minified via ant build script-->
	<script src="/assets/js/plugins.js"></script>
	<script src="/assets/js/script.js"></script>
	<!-- end scripts-->
</body>
</html>