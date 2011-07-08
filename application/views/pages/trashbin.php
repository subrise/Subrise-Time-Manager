<div class="wrapper content">
	
	<h1><?php echo $page_title ?></h1>

	<?php if (count($trash) > 0) { ?>
	<table>
		<tr>
			<th><?php echo $trash_type ?></th>
			<th>Restore</th>
			<th>Delete</th>
		</tr>

		<?php foreach ($trash as $item) { ?>

		<tr>
			<td><?php echo $item->name?></td>
			<td align="center"><a href="<?php echo $item->restore_url ?>" class="iconic cog" style="font-size:21px"></a></td>
			<td align="center"><a href="<?php echo $item->delete_url ?>" class="iconic trash delete" style="font-size:21px"></a></td>
		</tr>

		<?php } ?>

	</table>
	<?php } ?>

</div><!-- .wrapper.content -->