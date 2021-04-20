<div class="post-<?php echo get_the_ID();?>">
	<h2 class="header"><?php echo get_the_title() ?></h2>
	<div class="content">
	<?php if (is_single()) : ?>
		<?php the_content()?>
	<?php else : ?>
		<?php the_excerpt(); ?>	
		<a class="btn btn-readmore" href="<?php echo get_the_permalink(); ?>">Read More</a>
	<?php endif; ?>						
	</div>						
</div>

