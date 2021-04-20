<?php
/*for more details
https://kb.wpbakery.com/docs/inner-api/vc_map/
https://github.com/proteusthemes/visual-composer-elements
*/
/*function bartag_func( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
		'foo' => 'something',
		'css' => '',
	), $atts, 'bartag' );	
	if ($atts['css']){
		$data = explode('{', $atts['css']);	
		$css_class = str_replace(".", "", $data[0]);
	}
	return '<div class="element-wrapper '.$css_class.'" data-foo="'.$atts['foo'].'">'.$content.'</div>';
}
add_shortcode( 'bartag', 'bartag_func' );
add_action( 'vc_before_init', 'your_name_integrateWithVC' );
function your_name_integrateWithVC() {
	vc_map( array(
		"name" => __( "Bar tag test", "my-text-domain" ),
		"base" => "bartag",
		"class" => "",
		"category" => __( "Content", "my-text-domain"),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
				
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Text", "my-text-domain" ),
				"param_name" => "foo",
				"value" => __( "Default param value", "my-text-domain" ),
				"description" => __( "Description for foo param.", "my-text-domain" )
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Content", "my-text-domain" ),
				"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "my-text-domain" ),
				"description" => __( "Enter your content.", "my-text-domain" )
			), 
            // Design Options
            array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css' ),
	            'param_name' => 'css',
	            'group' => __( 'Design Options' ),
            )
		)
	));
}

function mos_accordion_shortcode($atts){
	// extract(shortcode_atts(array(
	// 	'title' => '',
	// 	'values' => '',
	// ), $atts));
	$atts = shortcode_atts( array(
		'title' => '',
		'values' => '',
	), $atts, 'mos-accordion' );	

	$list = '<h4>'.$atts['title'].'</h4>';
	$values = vc_param_group_parse_atts($atts['values']);

	$new_accordion_value = array();
	foreach($values as $data){
		$new_line = $data;
		$new_line['label'] = isset($new_line['label']) ? $new_line['label'] : '';
		$new_line['excerpt'] = isset($new_line['excerpt']) ? $new_line['excerpt'] : '';

		$new_accordion_value[] = $new_line;

	}

	$idd = 0;
	foreach($new_accordion_value as $accordion):
		$idd++;
		$list .=
		'<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$idd.'">
						'.$accordion['label'].'
						<span class="fa fa-plus"></span>
					</a>
				</h4>
			</div>
			<div id="collapse'.$idd.'" class="panel-collapse collapse">
				<div class="panel-body">
					<p>'.$accordion['excerpt'].'</p>
				</div>
			</div>
		</div>';
	endforeach;
	return $list;
	wp_reset_query();
}
add_shortcode('mos-accordion', 'mos_accordion_shortcode');

add_action( 'vc_before_init', 'mos_accordion_vc' );
function mos_accordion_vc() {
	vc_map(array(
		'name' => 'Mos Accordions',
		'base' => 'mos-accordion',
		"category" => __( "Mos Elements", "my-text-domain"),
		'icon'     => get_template_directory_uri() . '/images/mos-vc.png',
		'params' => array(
			array(
				'type' => 'textfield',
				'name' => __('Title', 'rrf-mos'),
				'holder' => 'div',
				'heading' => __('Title', 'rrf-mos'),
				'param_name' => 'title',
			),
			array(
				'type' => 'param_group',
				'param_name' => 'values',
				'params' => array(
					array(
						'type' => 'textfield',
						'name' => 'label',
						'heading' => __('Heading', 'rrf-mos'),
						'param_name' => 'label',
						),
					array(
						'type' => 'textarea',
						'name' => 'Content',
						'heading' => __('Content', 'rrf-mos'),
						'param_name' => 'excerpt',
					)
				)

			),
		),

	));
}
*/


function mos_product_carousel_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'products' => '',
		'show' => 3,
		'scroll' => 1,
		'speed' => 2000,		
		'dots' => false,
		'arrows' => false,
		'breakpoint-1024' => 3,
		'breakpoint-600' => 2,
		'breakpoint-480' => 1,
	), $atts, 'mos_product_carousel' );	
	$arr = explode(',', $atts['products']);
	if (sizeof($arr)){
		$id = rand(1000,9999).strtotime("now");
		$html .= '<div class="slick-slider mos-product-slider slick-slider-shortcode mos-products" id="'.$id.'">';
		foreach ($arr as $product_id) {
			$product = wc_get_product( $product_id );
			// $product->get_regular_price();
			// $product->get_sale_price();
			// $product->get_price();
			$html .= '<div class="position-relative text-center product-'.$product_id.'">';
			$html .= '<div class="badge-con mb-1">';
			if(get_post_meta( $product_id, '_purnava_product_hot', $single )){
	        	$html .= '<span class="badge badge-pill badge-warning badge-product">HOT</span>';
			}
			$html .= '</div>';
			$attachment_id = get_post_thumbnail_id( $product_id );
			$html .= '<div class="product-image"><img class="img-fluid img-product w-100" src="'.aq_resize(wp_get_attachment_url( $attachment_id ), 364,275,true).'" alt="'.get_the_title($product_id).'"></div>';
			$html .= '<div class="product-title">'.get_the_title($product_id).'</div>';
			$html .= '<div class="product-price">';
			$html .= '<span class="price">';
			if ($product->get_sale_price()){
				$html .= '<del>'.wc_price($product->get_regular_price()).'</del>';
				$html .= '<ins>'.wc_price($product->get_sale_price()).'</ins>';
			} else {
				$html .= '<ins>'.wc_price($product->get_regular_price()).'</ins>';				
			}
			$html .= '</span>';
			
			$html .= '</div>';
			if ($product->get_sale_price()) {
				$html .= '<div class="product-off">'.number_format((100 * ($product->get_regular_price()-$product->get_sale_price()))/$product->get_regular_price(), 2) .'%</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';
	}
	$dots = ($atts['dots'])? 'true' : 'false';
	$arrows = ($atts['arrows'])? 'true' : 'false';
	$html .= '<script>jQuery(document).ready(function($){$("#'.$id.'").slick({slidesToShow:'.$atts['show'].',slidesToScroll:'.$atts['scroll'].',autoplay:true,autoplaySpeed:'.$atts['speed'].',focusOnSelect:true,dots:'.$dots.',arrows:'.$arrows.',responsive:[{breakpoint:1024,settings:{slidesToShow:'.$atts['breakpoint-1024'].',}},{breakpoint:600,settings:{slidesToShow:'.$atts['breakpoint-600'].',centerMode:true,}},{breakpoint:480,settings:{slidesToShow:'.$atts['breakpoint-480'].',centerMode:true}}]})})</script>'; 
	
	return $html;
}
add_shortcode( 'mos_product_carousel', 'mos_product_carousel_func' );
add_action( 'vc_before_init', 'mos_product_carousel_vc' );
function mos_product_carousel_vc() {
	$products = mos_get_posts('product');
	$option = array();
	foreach ($products as $id => $name) {
		$option[$name] = $id;
	}
	vc_map( array(
		"name" => __( "Mos Product Carousel", "my-text-domain" ),
		"base" => "mos_product_carousel",
		"class" => "",
		"category" => __( "Content", "my-text-domain"),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		//'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				
		"params" => array(
			array(
				"type" => "dropdown_multi",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Images", "my-text-domain" ),
				"param_name" => "products",
				// "admin_label" => false,
				"value" => $option,
				"description" => __( "Products for slider.", "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides to Show", "my-text-domain" ),
				"param_name" => "show",
				"value" => __( 3, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides to Scroll", "my-text-domain" ),
				"param_name" => "scroll",
				"value" => __( 1, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides Speed", "my-text-domain" ),
				"param_name" => "speed",
				"value" => __( 2000, "my-text-domain" ),
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Dots", "my-text-domain" ),
				"param_name" => "dots",
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Arrows", "my-text-domain" ),
				"param_name" => "arrows",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 1024", "my-text-domain" ),
				"param_name" => "breakpoint-1024",
				"value" => __( 3, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 600", "my-text-domain" ),
				"param_name" => "breakpoint-600",
				"value" => __( 2, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 400", "my-text-domain" ),
				"param_name" => "breakpoint-400",
				"value" => __( 1, "my-text-domain" ),
			),
		)
	));
}


function mos_image_carousel_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'images' => '',
		'show' => 3,
		'scroll' => 1,
		'speed' => 2000,		
		'dots' => false,
		'arrows' => false,
		'breakpoint-1024' => 3,
		'breakpoint-600' => 2,
		'breakpoint-480' => 1,
	), $atts, 'mos_image_carousel' );	
	$arr = explode(',', $atts['images']);
	if (sizeof($arr)){
		$id = rand(1000,9999).strtotime("now");
		$html .= '<div class="slick-slider slick-slider-shortcode" id="'.$id.'">';
		foreach ($arr as $attachment_id) {
			$html .= '<img class="img-fluid img-slick-carousel" src="'.wp_get_attachment_url( $attachment_id ).'">';
		}
		$html .= '</div>';
	}
	$dots = ($atts['dots'])? 'true' : 'false';
	$arrows = ($atts['arrows'])? 'true' : 'false';
	$html .= '<script>jQuery(document).ready(function($){$("#'.$id.'").slick({slidesToShow:'.$atts['show'].',slidesToScroll:'.$atts['scroll'].',autoplay:true,autoplaySpeed:'.$atts['speed'].',focusOnSelect:true,dots:'.$dots.',arrows:'.$arrows.',responsive:[{breakpoint:1024,settings:{slidesToShow:'.$atts['breakpoint-1024'].',}},{breakpoint:600,settings:{slidesToShow:'.$atts['breakpoint-600'].',centerMode:true,}},{breakpoint:480,settings:{slidesToShow:'.$atts['breakpoint-480'].',centerMode:true}}]})})</script>'; 
	
	return $html;
}
add_shortcode( 'mos_image_carousel', 'mos_image_carousel_func' );
add_action( 'vc_before_init', 'mos_image_carousel_vc' );
function mos_image_carousel_vc() {
	vc_map( array(
		"name" => __( "Mos Image Carousel", "my-text-domain" ),
		"base" => "mos_image_carousel",
		"class" => "",
		"category" => __( "Content", "my-text-domain"),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		//'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				
		"params" => array(
			array(
				"type" => "attach_images",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Images", "my-text-domain" ),
				"param_name" => "images",
				// "admin_label" => false,
				// "value" => __( "Default param value", "my-text-domain" ),
				"description" => __( "Images for slider.", "my-text-domain" )
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides to Show", "my-text-domain" ),
				"param_name" => "show",
				"value" => __( 3, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides to Scroll", "my-text-domain" ),
				"param_name" => "scroll",
				"value" => __( 1, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Slides Speed", "my-text-domain" ),
				"param_name" => "speed",
				"value" => __( 2000, "my-text-domain" ),
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Dots", "my-text-domain" ),
				"param_name" => "dots",
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Arrows", "my-text-domain" ),
				"param_name" => "arrows",
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 1024", "my-text-domain" ),
				"param_name" => "breakpoint-1024",
				"value" => __( 3, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 600", "my-text-domain" ),
				"param_name" => "breakpoint-600",
				"value" => __( 2, "my-text-domain" ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Break Point 400", "my-text-domain" ),
				"param_name" => "breakpoint-400",
				"value" => __( 1, "my-text-domain" ),
			),
		)
	));
}

function mos_poduct_categories_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'p-categories' => '',
		'large' => 'col-lg-2',
		'small' => 'col-4',
	), $atts, 'owl_carousel' );	
	$arr = explode(',', $atts['p-categories']);	
	if ($arr) {
		$html .= '<div class="row mos-product-categories">';
		foreach ($arr as $cat){
			$html .= '<div class="'.$atts['small'].' '.$atts['large'].' mb-2 mb-lg-0">';
			$html .= '<div class="mos-category-unit h-100 position-relative text-center">';
			$thumbnail_id = get_woocommerce_term_meta( $cat, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
			$term = get_term_by('id', $cat, 'product_cat');
				$html .= '<img class="img-fluid img-product-category" src="'.$image.'" alt="' . $term->name .'">';
				$html .= '<div class="cat-name">' . $term->name .'</div>';
				$html .= '<a href="'.get_term_link($term->slug, 'product_cat').'" class="hidden-link">Read more</a>';
			$html .= '</div>';
			$html .= '</div>';
		}
		$html .= '</div>';
	}
	return $html;
}
add_shortcode( 'mos_poduct_categories', 'mos_poduct_categories_func' );
add_action( 'vc_before_init', 'mos_poduct_categories_vc' );
function mos_poduct_categories_vc() {
	$product_cats = mos_get_terms('product_cat');
	$option = array();
	foreach ($product_cats as $product_cat) {
		$option[$product_cat['name']] = $product_cat['term_id'];
	}
	vc_map( array(
		"name" => __( "Mos Product Category", "my-text-domain" ),
		"base" => "mos_poduct_categories",
		"class" => "",
		"category" => __( "Content", "my-text-domain"),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		// 'icon'     => get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg',
				
		"params" => array(
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"holder" => "div",
				"heading" => __( "Select Categories", "my-text-domain" ),
				"param_name" => "p-categories",
				"value" => $option,
				"description" => __( "You can use CTRL or ALT key for select multiple options.", "my-text-domain" )
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Large Device Grid", "my-text-domain" ),
				"param_name" => "large",
				"value" => array(
					'2 Grids View' => 'col-md-6',
					'3 Grids View' => 'col-md-4',
					'4 Grids View' => 'col-md-3',
					'6 Grids View' => 'col-md-2',
				),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Small Device Grid", "my-text-domain" ),
				"param_name" => "small",
				"value" => array(
					'2 Grids View' => 'col-6',
					'3 Grids View' => 'col-4',
					'4 Grids View' => 'col-3',
					'6 Grids View' => 'col-2',
				),
			),
		)
	));
}

	// $product_cats = mos_get_terms('product_cat');
	// $option = array();
	// foreach ($product_cats as $product_cat) {
	// 	$option[$product_cat['term_id']] = $product_cat['name'];
	// }
	// var_dump($option);
/*Custom components*/
// Create multi dropdown param type
vc_add_shortcode_param( 'dropdown_multi', 'dropdown_multi_settings_field' );
function dropdown_multi_settings_field( $param, $value ) {
   $param_line = '';
   $param_line .= '<select multiple name="'. esc_attr( $param['param_name'] ).'" class="select2 wpb_vc_param_value wpb-input wpb-select '. esc_attr( $param['param_name'] ).' '. esc_attr($param['type']).'">';
   foreach ( $param['value'] as $text_val => $val ) {
       if ( is_numeric($text_val) && (is_string($val) || is_numeric($val)) ) {
                    $text_val = $val;
                }
                $text_val = __($text_val, "js_composer");
                $selected = '';

                if(!is_array($value)) {
                    $param_value_arr = explode(',',$value);
                } else {
                    $param_value_arr = $value;
                }

                if ($value!=='' && in_array($val, $param_value_arr)) {
                    $selected = ' selected="selected"';
                }
                $param_line .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
            }
   $param_line .= '</select>';

   return  $param_line;
}
/*Custom components*/
?>