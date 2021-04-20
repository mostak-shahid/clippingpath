<?php /*Template Name: Thanks Page Template*/ ?>
<?php 
global $clippingpath_options;
$from_theme_option = $clippingpath_options['general-page-sections'];
$from_page_option = get_post_meta( get_the_ID(), '_clippingpath_page_section_layout', true );
$sections = (@$from_page_option['Enabled'])?$from_page_option['Enabled']:$from_theme_option['Enabled'];
unset($sections['content']);
?><?php get_header() ?>
<?php 
$class = $clippingpath_options['sections-content-class'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
if (has_post_thumbnail(get_the_ID())){
	$background_img = get_the_post_thumbnail_url(get_the_ID());
}
do_action( 'action_avobe_blank', $page_details ); 
?>
<section id="page" class="page-content <?php if(@$clippingpath_options['sections-content-background-type'] == 1) echo @$clippingpath_options['sections-content-background'] . ' ';?><?php if(@$clippingpath_options['sections-content-color-type'] == 1) echo @$clippingpath_options['sections-content-color'];?> <?php echo $class ?>" <?php if(@$background_img) echo 'style="background-image:url('.$background_img.')"'; ?>>
	<div class="content-wrap">
		<div class="container">
					<?php if ( have_posts() ) :?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'page' ) ?>
						<?php endwhile;?>	
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif;?>
		</div>	
	</div>
</section>
<?php do_action( 'action_below_blank', $page_details  ); ?>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer() ?>