<div class="wrapper content">

	<h1>Projects</h1>
	<p>Below you see an overview of all the projects in the database.</p>

	<ul class="menu hor">
		<li>
			<span class="iconic arrow-right-alt" style="font-size:21px"></span>
			<a href="<?php echo URL::site('project/edit')?>">
				 Add new project
			</a>
		</li>
		<?php
			$trashed = ORM::factory('project')->where('trashed','=',1)->find();
			if ($trashed->loaded()) :
		?>
		<li>
			<span class="iconic trash" style="font-size:21px"></span>
			<a href="<?php echo URL::site('project/trashbin')?>">
				 Trash bin
			</a>
		</li>
		<?php endif; ?>
	</ul><!-- .menu.hor -->
	
	<?php if ($projects->count() > 0) { ?>
	<table>
		<tr>
			<th>Project name</th>
			<th>Time spend:</th>
			<th>By You</th>
			<th>By All</th>
		</tr>

		<?php foreach ($projects as $project) {  ?>
		
		<tr>
			<td><a href="<?php echo URL::site('project/show/'.$project->id)?>"><?php echo $project->name?></a></td>
			<td></td>
			<td><?php 
				$time = $project->time_spend(Auth::instance()->get_user()->id);
				echo $time->hours . ':';
				if ($time->minutes < 10) 
					echo '0';
				echo $time->minutes;
				?></td>
			<td><?php 
				$time = $project->time_spend();
				echo $time->hours . ':';
				if ($time->minutes < 10) 
					echo '0';
				echo $time->minutes;
				?></td>
		</tr>

		<?php } ?>

	</table>
	<?php } else { ?>
	<p>There are currently no projects in the database.</p>
	<?php } ?>
	
</div><!-- .wrapper -->
