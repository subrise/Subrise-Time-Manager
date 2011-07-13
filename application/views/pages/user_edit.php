<div class="wrapper content">
	
	<h1><?php echo $page_title ?></h1>

	<?php echo Form::open('user/edit/'.$user->id, array('id' => 'frmUserEdit')) ?>

		<p>
			<label for="txtUsername">Username:</label>
			<input id="txtUsername" type="text" name="username" value="<?php echo $user->username; ?>">
		</p>
		<p>
			<label for="txtEmail">Email:</label>
			<input id="txtEmail" type="text" name="email" value="<?php echo $user->email; ?>">
		</p>
		<p>
			<label for="txtPassword">Password:</label>
			<input id="txtPassword" type="password" name="password">
		</p>
		<p>
			<label for="txtPassword2">Re-enter your password:</label>
			<input id="txtPassword2" type="password" name="password2">
		</p><br class="clear">
		
		<fieldset>
			<legend>Roles</legend>
			
			<p>
				<label for="checkLogin">Login</label>
				<input type="checkbox" name="roles[]" value="1" id="checkLogin">
			</p>
			
		</fieldset>
		
		<p>
			<input class="submit" type="submit" name="edit" value="Save">
		</p>
	</form>
	
</div><!-- .wrapper -->