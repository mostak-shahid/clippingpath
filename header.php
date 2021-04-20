<?php 
global $clippingpath_options;
if (is_home()) $page_id = get_option( 'page_for_posts' );
elseif (is_front_page()) $page_id = get_option('page_on_front');
else $page_id = get_the_ID();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo get_post_meta( get_the_ID(),'_yoast_wpseo_focuskw', true ) ?>">
    <meta name="description" content="<?php echo get_post_meta( get_the_ID(),'_yoast_wpseo_metadesc', true ) ?>">
	<meta name="author" content="Md. Mostak Shahid">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<input id="loader-status" type="hidden" value="<?php echo $clippingpath_options['misc-page-loader'] ?>">
<?php if ($clippingpath_options['misc-page-loader']) : ?>
    <div class="se-pre-con">
    <?php if ($clippingpath_options['misc-page-loader-image']['url']) : ?>
        <img class="img-responsive animation <?php echo $clippingpath_options['misc-page-loader-image-animation'] ?>" src="<?php echo do_shortcode( $clippingpath_options['misc-page-loader-image']['url'] ); ?>">
    <?php else : ?>
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <?php endif; ?>
    </div>
<?php endif; ?>  
	<?php 
	$topbar_class=@$clippingpath_options['sections-topbar-class']; 
	$header_class=@$clippingpath_options['sections-header-class']; 
	$title_class=@$clippingpath_options['sections-title-class']; 
	$breadcrumbs_class=@$clippingpath_options['sections-breadcrumbs-class']; 
	?>
    <section id="section-topbar" class="<?php if(@$clippingpath_options['sections-topbar-background-type'] == 1) echo @$clippingpath_options['sections-topbar-background'] . ' ';?><?php if(@$clippingpath_options['sections-topbar-color-type'] == 1) echo @$clippingpath_options['sections-topbar-color'];?> <?php echo $topbar_class?>">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <?php echo do_shortcode('[address index=1]')?>
                    </div>
                    <div class="col-2"><?php echo do_shortcode('[email index=1]')?></div>
                    <div class="col-8">
                        <?php
                            wp_nav_menu([
                                'menu'            => 'topmenu',
                                'theme_location'  => 'topmenu',
                                'depth'           => 1,
                            ]);
                        ?>
                    </div>
                </div>                
            </div>
        </div>
    </section>
	<header id="main-header" class="<?php if(@$clippingpath_options['sections-header-background-type'] == 1) echo @$clippingpath_options['sections-header-background'] . ' ';?><?php if(@$clippingpath_options['sections-header-color-type'] == 1) echo @$clippingpath_options['sections-header-color'];?> <?php echo $header_class?>">
		<div class="content-wrap">
			<div class="container">		
				<div class="row">
				    <div class="col-lg-2 col-auto">
				        <?php echo do_shortcode('[site-identity]') ?>
				    </div>
				    <col-lg-6 class="col">	
                        <?php
                        wp_nav_menu([
                            'menu'            => 'mainmenu',
                            'theme_location'  => 'mainmenu',
                        ]);
                        ?>
				        
				    </col-lg-6>
				    <div class="col-lg-2">
                        <div class="d-none d-lg-block phone-block text-right">
                            Our Hot Line<br/>
                            <?php echo do_shortcode('[phone index=1]') ?>
                        </div>
                    </div>
				    <div class="col-lg-2">
                        <div class="d-none d-lg-block link-block text-right">
				            <a class="btn btn-block btn-lg font-weight-bold rounded-pill btn-outline-theme" href="#">Our Pricing</a>
                        </div>
				    </div>
				</div>				
			</div>
		</div>
	</header>
	<?php if (!get_post_meta($page_id, '_clippingpath_banner_disable', true )) : ?>
		<?php 
		$banner_img = get_post_meta( get_the_ID(), '_clippingpath_banner_cover', true ); 
		$banner_mp4 = get_post_meta( get_the_ID(), '_clippingpath_banner_mp4', true ); 
		$banner_webm = get_post_meta( get_the_ID(), '_clippingpath_banner_webm', true ); 
		$banner_shortcode = get_post_meta( get_the_ID(), '_clippingpath_banner_shortcode', true ); 
		?>
		<section id="page-title" class="<?php if(@$clippingpath_options['sections-title-background-type'] == 1) echo @$clippingpath_options['sections-title-background'] . ' ';?><?php if(@$clippingpath_options['sections-title-color-type'] == 1) echo @$clippingpath_options['sections-title-color'];?> <?php echo $title_class ?>">
			<?php if ($banner_shortcode) : ?>
				<div class="shortcode-output"><?php echo do_shortcode( $banner_shortcode ); ?></div>
			<?php elseif ($banner_mp4 OR $banner_webm) : ?>
				<div class="video-output">
					<video id="banner-video" autoplay loop muted playsinline <?php if ($banner_img) : ?> style="background-image:url(<?php echo $banner_img ?>)" <?php endif; ?>>
					<?php if($banner_mp4) : ?>
						<source src="<?php echo $banner_mp4 ?>">
					<?php endif; ?>
					<?php if($banner_webm) : ?>
						<source src="<?php echo $banner_webm ?>">
					<?php endif; ?>
					</video>					
				</div>
			<?php endif; ?>
			<div class="content-wrap">
				<div class="container">
					<?php 
					if (is_home()) :
						$page_for_posts = get_option( 'page_for_posts' );
					$title = get_the_title($page_for_posts);
					elseif (is_404()) :
						$title = '404 Page';
					elseif(is_tax()) :
						$title = single_term_title( '', false );
					elseif(is_plugin_active('woocommerce/woocommerce.php')) :
						if (is_shop()) :
							$title = get_the_title(get_option('woocommerce_shop_page_id'));
						endif;
					else :
						$title = get_the_title();
					endif; 
					?>
					<span class="heading"><?php echo $title ?></span>
				</div>
			</div>
		</section>
	<?php endif ?>
	<?php if (get_post_meta($page_id, '_clippingpath_breadcrumb_enable', true )) : ?>
		<section id="section-breadcrumbs" class="<?php if(@$clippingpath_options['sections-breadcrumbs-background-type'] == 1) echo @$clippingpath_options['sections-breadcrumbs-background'] . ' ';?><?php if(@$clippingpath_options['sections-breadcrumbs-color-type'] == 1) echo @$clippingpath_options['sections-breadcrumbs-color'];?> <?php echo $breadcrumbs_class ?>">
			<div class="content-wrap">
				<div class="container">
					<?php mos_breadcrumbs(); ?>
				</div>
			</div>
		</section>
	<?php endif; ?>