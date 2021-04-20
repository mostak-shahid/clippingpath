<?php /*Template Name: Lightbox Page Template*/ ?>
<?php 
global $clippingpath_options;
$class = $clippingpath_options['sections-content-class'];
$from_theme_option = $clippingpath_options['general-page-sections'];
$from_page_option = get_post_meta( get_the_ID(), '_clippingpath_page_section_layout', true );
$sections = (@$from_page_option['Enabled'])?$from_page_option['Enabled']:$from_theme_option['Enabled'];
unset($sections['content']);
?><?php get_header() ?>
<section id="page" class="page-content <?php if(@$clippingpath_options['sections-content-background-type'] == 1) echo @$clippingpath_options['sections-content-background'] . ' ';?><?php if(@$clippingpath_options['sections-content-color-type'] == 1) echo @$clippingpath_options['sections-content-color'];?> <?php echo $class ?>">
	<div class="content-wrap">
			<?php if ( have_posts() ) :?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if (has_post_thumbnail()):?>
						<div class="page-img-container">
							<?php the_post_thumbnail('blog-image-full', array('class' => 'img-fluid img-blog img-centered'))?>
						</div>
					<?php endif;?>						
					<div class="container">
						<?php get_template_part( 'content', 'page' ) ?>

							<?php 
							$gallery_images = get_post_meta( get_the_ID(), '_clippingpath_gallery_images', true );					
							$layout = ( get_post_meta( get_the_ID(), '_clippingpath_gallery_layout', true ) ) ? get_post_meta( get_the_ID(), '_clippingpath_gallery_layout', true ) : '6';
							$large_image_size =  get_post_meta( get_the_ID(), '_clippingpath_large_image_size', true );
							$image_width =  get_post_meta( get_the_ID(), '_clippingpath_image_width', true );
							$image_height =  get_post_meta( get_the_ID(), '_clippingpath_image_height', true );
							$image_per_page =  get_post_meta( get_the_ID(), '_clippingpath_image_per_page', true );
							?>
							<?php if($gallery_images) : ?>
								<div id="gallery" class="row">
									<?php foreach ( $gallery_images as $attachment_id => $attachment_url ) : ?>
										<?php $raw_url = wp_get_attachment_url( $attachment_id ) ?>	
										<div class="col-md-6 col-lg-<?php echo $layout ?> text-center">
											<div class="img-container">
												<a href="<?php if ($large_image_size == 'max') echo aq_resize($raw_url, 1920); elseif ($large_image_size == 'container') echo aq_resize($raw_url, 1140); else echo $raw_url ?>" data-fancybox="gallery" data-caption="">
													<?php 
													$attachment_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ); 
													if ($image_width OR $image_height ) $img_url = aq_resize($raw_url, $image_width, $image_height, true);
													else $img_url = $raw_url;
													?>
													<img class="img-fluid img-gallery" src="<?php echo $img_url; ?>" alt="<?php echo $attachment_alt; ?>">
												</a>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="galleryHolder"></div>
							<?php endif; ?>

					</div>
				<?php endwhile;?>	


			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif;?>			
	</div>
</section>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer() ?>
<?php if($gallery_images) : ?>
<script>
jQuery(document).ready(function($) {	
	$("div.galleryHolder").jPages({
        containerID: "gallery",
        perPage: <?php echo $image_per_page ?>,
        previous: "prev",
        next: "next",
    });
    if ($(".galleryHolder a").length <= 3){
    	$('.galleryHolder').hide();
    }
});	
</script>
<?php endif?>