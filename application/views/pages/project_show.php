<section class="wrapper">
	<article>
		<header>
			<h1><?php echo $project->name ?></h1>
		</header>

		<?php echo XgMarkdown_Parser::parse($project->note) ?>
		
		<aside class="activities">
			<h2>Activities</h2>
			<nav>
				<span class="iconic arrow-right-alt"></span>
				<a href="<?php echo URL::site('activity/add/'.$project->id) ?>">Add activity</a>
			</nav>
			<table>
				<tr>
					<th>Name</th>
					<th>Time spend:</th>
					<th>By You</th>
					<th>By All</th>
				</tr>
				<?php foreach ($activities as $activity) { ?>
				<tr>
					<td>
						<a href="/activity/show/<?php echo $activity->id ?>"><?php echo $activity->name ?></a>
					</td>
					<td>&nbsp;</td>
					<td>
						<?php 
							$time = $activity->time_spend(Auth::instance()->get_user()->id);
							echo $time->hours.':';
							if ($time->minutes < 10)
								echo '0';
							echo $time->minutes;
						?>
					</td>
					<td>
						<?php 
							$time = $activity->time_spend();
							echo $time->hours.':';
							if ($time->minutes < 10)
								echo '0';
							echo $time->minutes;
						?>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						<h2>
						<?php 
							$time = $project->time_spend(Auth::instance()->get_user()->id);
							echo $time->hours.':';
							if ($time->minutes < 10)
								echo '0';
							echo $time->minutes;
						?>
						</h2>
					</td>
					<td>
						<h2>
						<?php 
							$time = $project->time_spend();
							echo $time->hours.':';
							if ($time->minutes < 10)
								echo '0';
							echo $time->minutes;
						?>
						</h2>
					</td>
				</tr>
			</table>
		</aside>
	
		<footer>
			<nav>
				<ul class="clearfix">
					<li>
						<span class="iconic cog"></span>
						<a href="<?php echo URL::site('project/edit/'.$project->id)?>">Edit</a>
					</li>
				</ul>
			</nav>
		</footer>
	</article>
	
	
	
</section><!-- .wrapper -->