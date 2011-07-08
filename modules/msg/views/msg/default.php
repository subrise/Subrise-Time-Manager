<?php if ( count( $messages ) ) { ?>
	
	<ul id="messages">		
			<?php foreach ($messages as $message): ?>
			<li class="<?php echo $message['type'] ?>">
				<p><span><?php echo $message['text'] ?></span></p>
			</li>
			<?php endforeach ?>
	</ul><!-- #messages -->
	
	
<?php } ?>
