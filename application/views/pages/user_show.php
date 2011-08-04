<section class="wrapper">
	<article>
		<header>
			<h1><?php echo $user->username ?></h1>
		</header>
		
		<aside>
			<h2>Been busy?</h2>
			<table>
				<tr>
					<th>Activity</th>
					<th>Project</th>
					<th>Time spend:</th>
					<th>By You</th>
					<th>By All</th>
				</tr>
				<?php foreach ($activities as $activity) { ?>
				<tr>
					<td>
						<a href="/activity/show/<?php echo $activity->id ?>"><?php echo $activity->name ?></a>
					</td>
					<td><a href="/project/show/<?php echo $activity->project->id ?>"><?php echo $activity->project->name ?></a></td>
					
					<td>&nbsp;</td>
					<td>
						<?php 
							$time = $activity->time_spend($user->id);
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
			</table>
		</aside>
	</article>
	
</section><!-- .wrapper -->