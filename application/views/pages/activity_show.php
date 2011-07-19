<div class="wrapper content">
	<p>
		Project: <?php echo $activity->project->name ?><br>
		Activity: <?php echo $activity->name ?><br>
		<?php if ( ! empty($activity->note) ) : ?>
			Note:<br>
			<?php echo XgMarkdown_Parser::parse($activity->note) ?>
		<?php endif; ?>
	</p>
	<hr>
	<p>
		<?php if ($activity->estimate_hours) : ?>
		Estimate hours: <?php echo $activity->estimate_hours ?><br>
		<?php endif; ?>
		Worked: <?php echo Date::timetostr($worked_seconds) ?><br>
	</p>
	
	<?php if ('closed' == $status) : ?>
	<a class="button" href="<?php echo URL::site('activity/startclock/'.$activity->id) ?>">Start the clock</a>
	<?php else: ?>
	<p>
		Started recording <?php echo Date::fuzzy_span( $open_hour->start) ?><br>
		<a class="button" href="<?php echo URL::site('activity/stopclock/'.$activity->id) ?>">Stop the clock</a>
	</p>
	<?php endif; ?>
</div><!-- .wrapper.content -->