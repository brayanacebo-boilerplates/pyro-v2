	<?php if ($comments): ?>
	
	<?php foreach ($comments as $item): ?>
		
		<div class="comment">
			
			<div class="details">
				<div class="col-md-2">
					<div class="image">
						<?php echo gravatar($item->user_email, 60) ?>
					</div>
					<div class="name mtop10">
						<?php echo $item->user_name ?>
					</div>
					<div class="date">
						<p><?php echo format_date($item->created_on) ?></p>
					</div>
				</div>
				<div class="col-md-10">
					
				
					<?php if (Settings::get('comment_markdown') and $item->parsed): ?>
						<?php echo $item->parsed ?>
					<?php else: ?>
						<div class="blog_comment"><?php echo nl2br($item->comment) ?></div>
					<?php endif ?>
				</div>
				<div class="clear"></div>
				<div class="col-md-12">
					<hr>
				</div>
				
			</div>
		</div><!-- close .comment -->
		
		
	<?php endforeach ?>
	
<?php else: ?>
	<p><?php echo lang('comments:no_comments') ?></p>
<?php endif ?>