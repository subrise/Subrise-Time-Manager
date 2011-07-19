<div class="wrapper content">
	<h1><?php echo $page_title ?></h1>

	<?php echo Form::open('activity/add/'.$project_id) ?>
	
	<p>
		<label for="selProjects">Project</label>
		<?php echo Form::select('project_id', $project_options, $project_id, array('id'=>'selProjects')) ?>
	</p>
	<p>
		<label for="txtName">Activity name</label>
		<input type="text" name="name" value="" id="txtName" placeholder="The activity you're planning to do">
	</p>
	<p>
		<label for="txtNote">Note</label>
		<textarea name="note" rows="8" cols="40" placeholder="Some extra notes about the activity"></textarea>
	</p>
	
	<p><input type="submit" name="submit" value="Add activity"></p>
	
	</form>

</div><!-- .wrapper.content -->