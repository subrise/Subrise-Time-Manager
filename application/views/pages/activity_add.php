<div class="wrapper content">
	<h1><?php echo $page_title ?></h1>

	<?php echo Form::open('activity/add/'.$project_id) ?>
	
	<p>
		<label for="selProjects">Project</label>
		<?php echo Form::select('project_id', $project_options, $project_id, array('id'=>'selProjects')) ?>
	</p>
	<p>
		<label for="txtName">Activity name</label>
		<?php echo Form::input('name', $activity->name, array(
			'id' => 'txtName',
			'placeholder' => 'The name of what you are about to do for the project.',
			'required'
		)) ?>
	</p>
	<p>
		<label for="txtNote">Note</label>
		<?php echo Form::textarea('note', $activity->note, array(
			'id'          => 'txtNote',
			'placeholder' => 'Some extra description of what you are underetaking.',
		)) ?>
	</p>
	
	<p><input type="submit" name="submit" value="Add activity"></p>
	
	</form>

</div><!-- .wrapper.content -->