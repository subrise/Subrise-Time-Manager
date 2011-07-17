<div class="wrapper content">
	
	<h1><?php echo $project->name ?></h1>

	<?php echo XgMarkdown_Parser::parse($project->note) ?>
	
	
	<p>
		<a href="<?php echo URL::site('project/edit/'.$project->id)?>" class="iconic cog" style="font-size:21px"></a>
		<a href="<?php echo URL::site('project/edit/'.$project->id)?>">Edit</a>
	</p>
	<hr>
	
	<h1>Activities</h1>
	<p><a href="<?php echo URL::site('project') ?>">Activiteit toevoegen</a></p>
	<ul>
		<?php foreach ($activities as $activity) { ?>
			<li><?php echo $activity->name ?></li>
		<?php } ?>
	</ul>
	
</div><!-- .wrapper -->