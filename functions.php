<?php
show_admin_bar( false );
// add_filter('show_admin_bar', false, PHP_INT_MAX);
function disable_mytheme_action() {
	define('DISALLOW_FILE_EDIT', TRUE);
	define('DISALLOW_FILE_MODS',true);
}
//add_action('init','disable_mytheme_action');
require_once('functions/theme-init/plugin-update-checker.php');
$themeInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/clippingpath.json',
	__FILE__,
	'clippingpath'
);
require_once('functions/theme-functions.php');
require_once('functions/scripts.php');
require_once('functions/setup.php');
require_once('functions/shortcodes.php');
require_once('functions/widgets.php');
require_once('functions/custom-comments.php');
require_once('functions/theme-filter-hooks.php');
require_once('functions/ajax.php');

require_once('inc/theme-options/ReduxCore/framework.php'); 
//require_once('inc/theme-options/sample/sample-config.php');
require_once('functions/theme-options.php');
require_once('inc/theme-options/loader.php');

require_once('inc/metabox/init.php'); 
require_once('inc/metabox/custom-cmb2-fields.php'); 
require_once('inc/metabox/extensions/cmb-field-sorter/cmb-field-sorter.php');
require_once('functions/metaboxes.php'); 
require_once('inc/TGM-Plugin-Activation-develop/plugin-management.php');

require_once('functions/aq_resizer.php');
require_once('functions/Mobile_Detect.php');
require_once('functions/bs4navwalker.php');
require_once('functions/breadcrumb.php');

if (version_compare($GLOBALS['wp_version'], '5.0-beta', '>')) {    
    // WP > 5 beta
    add_filter('use_block_editor_for_post_type', '__return_false', 100);    
} else {    
    // WP < 5 beta
    add_filter('gutenberg_can_edit_post_type', '__return_false');    
}