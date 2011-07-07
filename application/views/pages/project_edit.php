<div class="wrapper">
	
	<h1><?php echo $page_title ?></h1>

	<?php echo Form::open('project/edit/'.$project->id) ?>

		<p>
			<label for="txtName">Project name:</label for="txtName">
			<input id="txtName" type="text" name="name" value="<?php echo $project->name; ?>" />
		</p>
		<p>
			<input class="submit" type="submit" name="edit" value="Save" />
		</p>
	</form>
	
</div><!-- .wrapper -->