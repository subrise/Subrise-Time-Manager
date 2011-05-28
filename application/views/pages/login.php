<h1>Login</h1>

<?php if (isset($error_feedback)):?>
	<div class="errorFeedback">
		<p><?php echo $error_feedback ?></p>
	</div><!-- .errorFeedback -->
<?php endif; ?>

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