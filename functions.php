<?php 

define('THORGATES_THEME_DIRECTORY', esc_url(trailingslashit(get_template_directory_uri())));
define('THORGATES_REQUIRE_DIRECTORY', trailingslashit(get_template_directory()));
define('THORGATES_VERSION', wp_get_theme()['Version']);
define('THORGATES_DEVELOPMENT', true);

require_once(TEMPLATEPATH . '/inc/helper-functions.php');
// require_once(TEMPLATEPATH . '/inc/woocommerce.php');
require_once(TEMPLATEPATH . '/inc/helper-templates.php');
require_once(TEMPLATEPATH . '/inc/ajax.php');
require_once(TEMPLATEPATH . '/inc/customize.php');
require_once(TEMPLATEPATH . '/inc/cpt.php');
require_once(TEMPLATEPATH . '/inc/enqueue.php');
require_once(TEMPLATEPATH . '/inc/shortcodes.php');
