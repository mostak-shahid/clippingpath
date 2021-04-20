<?php 
global $clippingpath_options; 
$class = $clippingpath_options['sections-content-class'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_content', $page_details ); 
?>
<section id="page" class="page-content <?php if(@$clippingpath_options['sections-content-background-type'] == 1) echo @$clippingpath_options['sections-content-background'] . ' ';?><?php if(@$clippingpath_options['sections-content-color-type'] == 1) echo @$clippingpath_options['sections-content-color'];?> <?php echo $class ?>">
	<div class="content-wrap">
		<div class="container">
			<?php do_action( 'action_before_content', $page_details  ); ?>
					<?php if ( have_posts() ) :?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'page' ) ?>
						<?php endwhile;?>	
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif;?>
			<?php do_action( 'action_after_content', $page_details  ); ?>
		</div>	
	</div>
</section>
<?php do_action( 'action_below_content', $page_details  ); ?>