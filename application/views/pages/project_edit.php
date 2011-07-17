<div class="wrapper content">
	
	<h1><?php echo $page_title ?></h1>

	<?php echo Form::open('project/edit/'.$project->id) ?>

		<p>
			<label for="txtName">Project name:</label>
			<input id="txtName" type="text" name="name" value="<?php echo $project->name; ?>" placeholder="Project name"/>
		</p>
		<p>
			<label for="txtNote">Note:</label>
			<textarea name="note" rows="18" cols="80" placeholder="Extra information regarding the project"><?php echo $project->note ?></textarea>
		</p>
		<p>
			<input class="submit" type="submit" name="edit" value="Save" />
		</p>
	</form>
	
</div><!-- .wrapper -->