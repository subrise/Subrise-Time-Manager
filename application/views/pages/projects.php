<div class="wrapper">

	<h1>Projects</h1>
	<p>This view will show an overview of all the projects from which you can edit them.</p>

	<?php echo  HTML::anchor('project/edit', 'Add new project') ?>

	<?php if ($projects->count() > 0) { ?>
	<table>
		<tr>
			<th>Naam project</th>
			<th>Bewerken</th>
		</tr>

		<?php foreach ($projects as $project) { ?>

		<tr>
			<td><?php echo $project->name?></td>
			<td>bewerken verwijderen</td>
		</tr>

		<?php } ?>

	</table>
	<?php } ?>
	
</div><!-- .wrapper -->
