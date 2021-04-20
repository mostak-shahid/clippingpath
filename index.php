<?php 
global $clippingpath_options;
if (is_home()) $page_id = get_option( 'page_for_posts' );
else $page_id = get_the_ID();

$from_theme_option = $clippingpath_options['archive-page-sections'];
$from_page_option = get_post_meta( $page_id, '_clippingpath_page_section_layout', true );
$sections = (@$from_page_option['Enabled'])?$from_page_option['Enabled']:$from_theme_option['Enabled'];
unset($sections['content']);
?><?php get_header() ?>
<section id="archive" class="page-content <?php if(@$clippingpath_options['sections-content-background-type'] == 1) echo @$clippingpath_options['sections-content-background'] . ' ';?><?php if(@$clippingpath_options['sections-content-color-type'] == 1) echo @$clippingpath_options['sections-content-color'];?>">
	<div class="content-wrap">
		<div class="container">
			<?php if ( have_posts() ) :?>
				<div id="blogs" class="row">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="col-lg-6">							
							<?php get_template_part( 'content', get_post_format() ) ?>
						</div>
					<?php endwhile;?>						
				</div>
				<div class="pagination-wrapper">
				<?php
					the_posts_pagination( array(
						'show_all' => false,
						'screen_reader_text' => " ",
						'prev_text'          => 'Prev',
						'next_text'          => 'Next',
					) );
				?>
				</div>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif;?>			
		</div>	
	</div>
</section>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer() ?>