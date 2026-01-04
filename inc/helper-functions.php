<?php

/**
 * Start Settings
 */
if ( ! function_exists( 'main_setup' ) ) :
    function main_setup() {
      /**
       * Enable support for Post Thumbnails on posts and pages.
       * @link //developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
       */
      add_theme_support( 'post-thumbnails' );
    }
    endif;
    add_action( 'after_setup_theme', 'main_setup' );

   


    /**
     * Add svg uploads
     */
  function svg_upload_allow( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';

    return $mimes;
  }

  add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

  function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

    if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
      $dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
    }
    else {
      $dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
    }

    if( $dosvg ){

      // разрешим
      if( current_user_can('manage_options') ){

        $data['ext']  = 'svg';
        $data['type'] = 'image/svg+xml';
      }
      // запретим
      else {
        $data['ext']  = false;
        $data['type'] = false;
      }

    }

    return $data;
  }

      add_filter( 'upload_mimes', 'svg_upload_allow' );

  /**
   * Register Menus
   */
 function register_my_menus() {
    register_nav_menus(
    array(
     'header-menu' => ( 'Header Menu' ),
     'technical-menu' => ( 'Technical Menu' ),
     'burger-menu' => ( 'Burger Menu' ),
     'aside-menu' => ( 'Aside Menu' ),
     'footer-menu' => ( 'Footer Menu' ),
     )
     );
    }
    add_action( 'init', 'register_my_menus' );

  
 /**
  * Create Additional Settings
  */

if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
      'page_title' => 'Дополнительные настройки',
      'menu_title' => 'Дополнительные настройки',
      'menu_slug' => 'theme-general-settings',
      'capability' => 'edit_posts',
      'redirect' => false,
  ));

}

/**
 * Remove p and br from content
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );


/**
 * Save json acf
 */

add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );

function my_acf_json_save_point( $path ) {

	// update path
	$path = get_stylesheet_directory() . '/acf-json';

	// return
	return $path;
}

    if(!function_exists('get_url_template')) {
      function get_url_template($template) {
        $page_query = new WP_Query(array(
          'post_type' => 'page', 
          'meta_key' => '_wp_page_template', 
          'meta_value' => $template, 
        ));
      
        if ($page_query->have_posts()) {
          $page_query->the_post();
          $permalink = get_permalink();
          wp_reset_postdata();
          return $permalink;
        }
        
        return '';
      }
    }
    

    /**
     * Add Class to menu
     */
    function add_menu_item_class( $classes, $item, $args ) {
      if ( isset( $args->item_class ) ) {
          $classes[] = $args->item_class;
      }
      return $classes;
  }
  add_filter( 'nav_menu_css_class', 'add_menu_item_class', 10, 3 );



/**
 * ACF Builder output in content()
 */

if(!function_exists('my_the_content_filter')) {
 add_filter('the_content', 'my_the_content_filter', 0);

function my_the_content_filter($content)
{
    if (is_page() || is_single()) {
        ob_start();
        ?>
        <?php
        if (have_rows('flexible')):
            while (have_rows('flexible')):
                the_row();
                get_template_part('template-parts/flexible/'. get_row_layout() , null );
            endwhile;
        endif;
        ?>
        <?php
        $content .= ob_get_clean();
    }
    
    return $content;
}
}

remove_filter('the_content', 'wpautop');
remove_filter('acf_the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
remove_filter('widget_text_content', 'wpautop');

function custom_wpautop($content) {
    // Если контент пуст, возвращаем пустой параграф
    if (trim($content) === '') {
        return '<p></p>';
    }

    // Разбиваем на строки
    $content_lines = explode("\n", $content);
    $new_content = '';
    $in_html_tag = false;

    foreach ($content_lines as $line) {
        // Проверяем, находится ли текущая строка внутри HTML-тега
        if (preg_match('/<[^>]*>/', $line)) {
            $new_content .= $line;
            // Определяем, открываем или закрываем HTML-тег
            $in_html_tag = substr_count($line, '<') > substr_count($line, '>');
            continue;
        }

        // Если мы вне HTML-тега, оборачиваем текст в параграф
        if (!$in_html_tag && trim($line) !== '' && strip_tags($line) === $line) {
            $new_content .= '<p>' . trim($line) . '</p>';
        } else {
            $new_content .= $line;
        }
    }

    return $new_content;
}

add_filter('the_content', 'custom_wpautop');
add_filter('acf_the_content', 'custom_wpautop');
add_filter('the_excerpt', 'custom_wpautop');
add_filter('widget_text_content', 'custom_wpautop');