<?php 
global $clippingpath_options; 
$class = $clippingpath_options['sections-about-class'];
$title = $clippingpath_options['sections-about-title'];
$subtitle = $clippingpath_options['sections-about-subtitle'];
$content = $clippingpath_options['sections-about-content'];
$media = $clippingpath_options['sections-about-media'];
$slides = $clippingpath_options['sections-about-slides'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_about', $page_details ); 
?>
<section id="section-about" class="<?php if(@$clippingpath_options['sections-about-background-type'] == 1) echo @$clippingpath_options['sections-about-background'] . ' ';?><?php if(@$clippingpath_options['sections-about-color-type'] == 1) echo @$clippingpath_options['sections-about-color'];?> <?php echo $class ?>">
	<div class="content-wrap">
		<div class="container">
		<?php do_action( 'action_before_about', $page_details ); ?>
				<?php if ($subtitle) : ?>				
					<div class="subtitle-wrapper wow fadeInDown">
						<h6 class="subtitle text-theme"><?php echo do_shortcode( $subtitle ); ?></h6>				
					</div>
				<?php endif; ?>
				<?php if ($title) : ?>				
					<div class="title-wrapper wow fadeInDown">
						<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper wow fadeInUp"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
				<div class="row align-items-center">
                    <?php if ($media['id']) : ?>
                        <div class="col-lg-6 wow fadeInLeft">
                            <img src="<?php echo aq_resize(wp_get_attachment_url($media['id']),540,400,true) ?>" alt="<?php echo get_post_meta($media['id'], '_wp_attachment_image_alt', TRUE) ?>" class="img-fluid img-about rounded" width="540" height="400">
                        </div>
                    <?php endif; ?>				    
				    <div class="col-lg-6 wow fadeInRight">				        
                        <!-- Nav pills -->
                        <?php if ($slides) : ?>
                            <ul class="nav nav-pills" role="tablist">
                                <?php $n = 0; ?>
                                <?php foreach($slides as $slide) : ?>   
                                    <li class="nav-item">
                                        <a class="nav-link <?php if(!$n) echo 'active' ?>" data-toggle="pill" href="#<?php echo create_slug(do_shortcode($slide['title'])) ?>"><?php echo do_shortcode($slide['title']) ?></a>
                                    </li>
                                    <?php $n++; ?>
                                <?php endforeach ?>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">                               
                                <?php $n = 0; ?>
                                <?php foreach($slides as $slide) : ?> 
                                    <div id="<?php echo create_slug(do_shortcode($slide['title'])) ?>" class="tab-pane  <?php if(!$n) echo 'active' ?>">
                                        <div class="description"><?php echo do_shortcode($slide['description']) ?></div>
                                        <?php if ($slide['link_title'] && $slide['link_url']) : ?>
                                            <a href="<?php echo esc_url(do_shortcode($slide['link_url'])) ?>" class="btn bg-theme text-white rounded-pill btn-about-tab"><?php echo do_shortcode($slide['link_title']) ?></a>
                                        <?php endif?>
                                    </div>
                                    <?php $n++; ?>
                                <?php endforeach ?>
                            </div>
                        <?php endif; ?>
				        
				    </div>
				</div>
		<?php do_action( 'action_after_about', $page_details ); ?>
		</div>	
	</div>
</section>
<?php do_action( 'action_below_about', $page_details  ); ?>