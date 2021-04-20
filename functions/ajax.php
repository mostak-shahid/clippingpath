<?php
/* AJAX action callback */
add_action( 'wp_ajax_reset_prl', 'reset_prl_ajax_callback' );
add_action( 'wp_ajax_nopriv_reset_prl', 'reset_prl_ajax_callback' );
/* Ajax Callback */
function reset_prl_ajax_callback () {
    $post_id = $_GET['post_id'];
    delete_post_meta($post_id, '_clippingpath_page_section_layout');
    //http://tippproperty.belocal.today/wp-admin/post.php?post=16&action=edit
    $location = admin_url('/') . 'post.php?post=' . $post_id . '&action=edit';
    wp_redirect( $location, $status = 302 );
    exit; // required. to end AJAX request.
}
/* AJAX action callback */
add_action( 'wp_ajax_dummy', 'dummy_ajax_callback' );
add_action( 'wp_ajax_nopriv_dummy', 'dummy_ajax_callback' );
/* Ajax Callback */
function dummy_ajax_callback () {
    $post_id = $_POST['product'];
    $output = array();
	echo json_encode($output);
    exit; // required. to end AJAX request.
}

