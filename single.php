<?php 
global $clippingpath_options;
$from_theme_option = $clippingpath_options['archive-page-sections'];
$sections = $from_theme_option['Enabled'];
unset($sections['content']);
?><?php get_header() ?>
<section id="blogs" class="page-content <?php if(@$clippingpath_options['sections-content-background-type'] == 1) echo @$clippingpath_options['sections-content-background'];?>">
	<div class="content-wrap">
		<div class="container">

			<?php if ( have_posts() ) :?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ) ?>
				<?php endwhile;?>	


			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif;?>
			<div class="post-linking">
				<div class="row">
					<div class="col-md-6 text-left">								
						<?php previous_post_link("%link", "Previous Post") ; ?>
					</div>
					<div class="col-md-6 text-right">
						<?php next_post_link("%link", "Next Post"); ?>
					</div>						
				</div>
			</div>
			<?php if (comments_open() || '0' != get_comments_number()) : comments_template(); endif;?>			

		</div>	
	</div>
</section>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer() ?>