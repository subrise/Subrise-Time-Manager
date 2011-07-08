<div class="wrapper content">

	<h1>Projects</h1>
	<p>This view will show an overview of all the projects from which you can edit them.</p>

	<ul class="menu hor">
		<li>
			<span class="iconic arrow-right-alt" style="font-size:21px"></span>
			<a href="<?php echo URL::site('project/edit')?>">
				 Add new project
			</a>
		</li>
		<li>
			<span class="iconic trash" style="font-size:21px"></span>
			<a href="<?php echo URL::site('project/trashbin')?>">
				 Trash bin
			</a>
		</li>
	</ul><!-- .menu.hor -->
	
	<?php if ($projects->count() > 0) { ?>
	<table>
		<tr>
			<th>Project name</th>
			<th>Edit</th>
			<th>Trash</th>
		</tr>

		<?php foreach ($projects as $project) { ?>

		<tr>
			<td><?php echo $project->name?></td>
			<td align="center"><a href="<?php echo URL::site('project/edit/'.$project->id)?>" class="iconic cog" style="font-size:21px"></a></td>
			<td align="center"><a href="<?php echo URL::site('project/trash/'.$project->id)?>" class="iconic trash" style="font-size:21px"></a></td>
		</tr>

		<?php } ?>

	</table>
	<?php } ?>
	
</div><!-- .wrapper -->
