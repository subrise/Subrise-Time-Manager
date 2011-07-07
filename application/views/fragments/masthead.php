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
			<p><?php echo $error_feedback ?></p>
		</div><!-- .errorFeedback -->
	<?php endif; ?>
	
	<ul id="menu_main">
		<li><a href="/">Welcome</a></li>
		<li><a href="<?php echo URL::site('project')?>">Projects</a></li>
		<li><a href="<?php echo URL::site('auth/logout')?>">Logout</a></li>
	</ul><!-- #menu_main -->