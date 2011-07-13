<div class="wrapper content">

	<h1>Users</h1>
	<p>This view will show an overview of all the users from which you can edit them.</p>

	<ul class="menu hor">
		<li>
			<span class="iconic arrow-right-alt" style="font-size:21px"></span>
			<a href="<?php echo URL::site('user/edit')?>">
				 Add new user
			</a>
		</li>
		<li>
			<span class="iconic trash" style="font-size:21px"></span>
			<a href="<?php echo URL::site('user/trashbin')?>">
				 Trash bin
			</a>
		</li>
	</ul><!-- .menu.hor -->
	
	<?php if ($users->count() > 0) { ?>
	<table>
		<tr>
			<th>User</th>
			<th>Edit</th>
			<th>Trash</th>
		</tr>

		<?php foreach ($users as $user) { ?>

		<tr>
			<td><?php echo $user->username?></td>
			<td align="center"><a href="<?php echo URL::site('user/edit/'.$user->id)?>" class="iconic cog" style="font-size:21px"></a></td>
			<td align="center"><a href="<?php echo URL::site('user/trash/'.$user->id)?>" class="iconic trash" style="font-size:21px"></a></td>
		</tr>

		<?php } ?>

	</table>
	<?php } ?>
	
</div><!-- .wrapper -->
