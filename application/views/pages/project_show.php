<div class="wrapper content">
	
	<h1><?php echo $project->name ?></h1>

	<?php echo XgMarkdown_Parser::parse($project->note) ?>
	
	<p>
		<span class="iconic cog" style="font-size:21px"></span>
		<a href="<?php echo URL::site('project/edit/'.$project->id)?>">Edit</a>
	</p>
	<hr>
	
	<h1>Activities</h1>
	<p>
		<span class="iconic arrow-right-alt" style="font-size:21px"></span>
		<a href="<?php echo URL::site('activity/add/'.$project->id) ?>">Add activity</a>
	</p>
	<ul>
		<?php foreach ($activities as $activity) { ?>
			<li><a href="/activity/show/<?php echo $activity->id ?>"><?php echo $activity->name ?></a></li>
		<?php } ?>
	</ul>
	
</div><!-- .wrapper -->