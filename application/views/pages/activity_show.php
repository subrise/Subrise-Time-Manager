<section class="wrapper">
	<article>
		<header>
			<h1><?php echo $activity->name ?> | <?php echo $activity->project->name ?><h1>
		</header>
		
		<?php if ( ! empty($activity->note) ) : ?>
			Note:<br>
			<?php echo XgMarkdown_Parser::parse($activity->note) ?>
		<?php endif; ?>
		
		<aside>
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
		</aside>
		
		<footer>
			<nav>
				<ul class="clearfix">
					<li>
						<span class="iconic cog"></span>
						<a href="<?php echo URL::site('activity/edit/'.$activity->id)?>">Edit</a>
					</li>
				</ul>
			</nav>
		</footer>
	</article>
</section><!-- .wrapper -->