<?php /*Template Name: Gallery Page Template*/ ?>
<?php get_header() ?>
<section id="page" class="page-content">
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
						$image_per_page =  get_post_meta( get_the_ID(), '_clippingpath_link_image_per_page', true );
						$gallery_images = get_post_meta( get_the_ID(), '_clippingpath_link_gallery_details_group', true );
						$layout = ( get_post_meta( get_the_ID(), '_clippingpath_link_gallery_layout', true ) ) ? get_post_meta( get_the_ID(), '_clippingpath_link_gallery_layout', true ) : '6';
						
						$image_width =  get_post_meta( get_the_ID(), '_clippingpath_link_image_width', true );
						$image_height =  get_post_meta( get_the_ID(), '_clippingpath_link_image_height', true );
						?>
						<?php if($gallery_images) : ?>
							<div id="gallery" class="row">
								<?php foreach ( $gallery_images as $gallery_image ) : ?>
									<div class="col-md-6 col-lg-<?php echo $layout ?> text-center">
										<div class="img-container">
											<?php
											$attachment_id = $gallery_image['_clippingpath_link_gallery_details_image_id'];
											$attachment_url = wp_get_attachment_url( $attachment_id ); 
											$attachment_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
											if ($image_width OR $image_height ) $img_url = aq_resize($attachment_url, $image_width, $image_height, true);
											else $img_url = $attachment_url;
										?>
										<img class="img-fluid img-gallery" src="<?php echo $img_url; ?>" alt="<?php echo  $attachment_alt; ?>">
										<span class="text"><?php echo $gallery_image['_clippingpath_link_gallery_details_text'] ?></span>
										<a class="hidden-link" href="<?php echo do_shortcode( $gallery_image['_clippingpath_link_gallery_details_url'] ) ?>">View Details</a>
										</div>
									</div>
								<?php endforeach;?>
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