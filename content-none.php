<?php
global $mospanelbeater_theme_options;
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 

?>
					<div id="error" class="text-center">
    					<div class="content-wrap">
					<?php if(is_home()) : ?>
						<img class="img-fluid img-centered img-content-none" src="<?php echo get_template_directory_uri() ?>/images/comingsoon.png" alt="<?php echo $alt_tag['inner'] ?>Coming Soon">
					<?php else : ?>
						<h2>OOOPPS.! THE CONTENT YOU WERE LOOKING FOR, COULDN'T BE FOUND.</h2>
						<?php if (is_search()) : ?>
							<p>Try searching for the best match or browse the links below:</p>
							<div class="row">
								<div class="col-md-4 col-md-offset-4">
									<?php get_search_form() ?>
								</div>
							</div>
							<br />
						<?php endif; ?>					    
					<?php endif; ?>
					<?php if(!is_front_page()):?>
						<a class="btn btn-success" href="<?php esc_url(bloginfo('home'))?>">GO BACK TO THE HOMEPAGE</a>
					<?php endif;?>
						</div>
					</div>
