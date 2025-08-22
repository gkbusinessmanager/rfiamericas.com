<?php
/**
* Hood Theme functions and definitions.
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package Hood Theme
*/
if ( ! function_exists( 'hood_theme_setup' ) ) :
/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
*/
function hood_theme_setup() {
/*
* Make theme available for translation.
* Translations can be filed in the /languages/ directory.
* If you're building a theme based on Hood Theme, use a find and replace
* to change 'hood-theme' to the name of your theme in all the template files.
*/
load_theme_textdomain( 'hood-theme', get_template_directory() . '/languages' );
// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );
// Tell the TinyMCE editor to use a custom stylesheet
add_editor_style('assets/css/editor-style.css');
// Set up the WordPress core custom background feature.
add_theme_support( 'custom-background', apply_filters( 'hood_theme_custom_background_args', array(
'default-color' => 'ffffff',
'default-image' => '',
) ) );
// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );
/*
* Let WordPress manage the document title.
* By adding theme support, we declare that this theme does not use a
* hard-coded <title> tag in the document head, and expect WordPress to
* provide it for us.
*/
add_theme_support( 'title-tag' );
/* Call Page and Post Metaboxes */


function removePanelCSS() {
  wp_dequeue_style( 'redux-admin-css' );
}
// This example assumes your opt_name is set to redux_demo, replace with your opt_name value
add_action( 'redux/page/hood_options/enqueue', 'removePanelCSS' );
function addAndOverridePanelCSS() {
wp_register_style( 'redux-custom-css', get_template_directory_uri() . '/inc/framework/css/redux-custom.css', array(), time(), 'all' );
wp_enqueue_style('redux-custom-css');

}
// This example assumes your opt_name is set to redux_demo, replace with your opt_name value
add_action('redux/page/hood_options/enqueue', 'addAndOverridePanelCSS', 2);




require_once get_template_directory() . '/inc/framework/barebones-config.php';
require get_template_directory() . '/inc/framework/config.php' ;
require get_template_directory() . '/inc/framework/loader.php' ;
/* #Page Navi */
function hood_theme_archive_navi($pages = '', $range = 3)
{
$showitems = ($range * 2)+1;
global $paged;
if(empty($paged)) $paged = 1;
if($pages == '')
{
global $wp_query;
$pages = $wp_query->max_num_pages;
if(!$pages)
{
$pages = 1;
}
}
if(1 != $pages)
{
echo "<div class='wp-pagenavi'>";
echo "<span>".$paged."/".$pages."</span>";
if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>First</a>";
if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&laquo;</a>";
for ($i=1; $i <= $pages; $i++)
{
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
{
echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
}
}
if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&raquo;</a>";
if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last</a>";
echo "</div>";
}
}
/*
* Enable support for Post Thumbnails on posts and pages.
*
* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
*/
add_theme_support( 'post-thumbnails' );
add_image_size( 'hood-theme-category-hrz', 270, 190, true );
add_image_size( 'hood-theme-blog-full', 845, 510, true );
set_post_thumbnail_size( 845, 510, true );
// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
'main-menu' => esc_html__( 'Main Menu', 'hood-theme' ),
'footer-menu' => esc_html__( 'Footer Menu', 'hood-theme' ),
) );
/*
* Switch default core markup for search form, comment form, and comments
* to output valid HTML5.
*/
add_theme_support( 'html5', array(
'search-form',
'comment-form',
'comment-list',
'gallery',
'caption',
) );
/**
* Starts the list before the elements are added.
*
* Adds classes to the unordered list sub-menus.
*
* @param string $output Passed by reference. Used to append additional content.
* @param int    $depth  Depth of menu item. Used for padding.
* @param array  $args   An array of arguments. @see wp_nav_menu()
*/

}
endif; // hood_theme_setup
add_action( 'after_setup_theme', 'hood_theme_setup' );
/**
* Enqueue scripts and styles.
*
* @since Hood Theme 1.0.0
*/
function hood_theme_scripts() {
// THEME STYLES
// Load our main stylesheet.
$css_path =  get_template_directory_uri() . '/assets/css/hood-style.css';
wp_enqueue_style( 'hood-theme-style', $css_path, array(), '1.0' );
//load font awesome
wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/includes/font-awesome/css/font-awesome.min.css', array(), '4.5.0' );
//load header im
wp_enqueue_style( 'header-im', get_template_directory_uri() . '/assets/css/header-im.css', array(), '1.0.0' );

global $hood_options;
$hood_skin = $hood_options['general-web-color'];

// Load our color stylesheet
wp_enqueue_style('hoodtheme-color', get_template_directory_uri() . '/assets/css/color/'. $hood_skin .'', array(), '1.0.0');

// load bootstrap style
wp_enqueue_style( 'boostrap', get_template_directory_uri() . '/includes/bootstrap/css/bootstrap.min.css', array(), '3.3.6' );
// load custom style
wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/assets/css/hood-custom-style.css', array(), '1.0.0' );

// load hood options style
wp_enqueue_style( 'comment-style', get_template_directory_uri() . '/assets/css/hood-options.css', array(), '1.0.0' );
wp_enqueue_style( 'hood-woocommerce', get_template_directory_uri() . '/assets/css/hood-woocommerce.css', array(), '1.0.0' );
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
// THEME SCRIPTS
wp_enqueue_script( 'navigation.js', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
wp_enqueue_script( 'boostrap.js', get_template_directory_uri() . '/includes/bootstrap/js/bootstrap.min.js', array(), '20130117', true );
wp_enqueue_script( 'hood-theme-app', get_template_directory_uri() . '/assets/js/hood-app.js', array(), '20130118', true );
wp_enqueue_script( 'controller.js', get_template_directory_uri() . '/assets/js/controller.js', array(), '20120207', true );
wp_enqueue_script( 'smartmenus.js', get_template_directory_uri() . '/includes/smartmenus/jquery.smartmenus.js', array(), '20130121', true );
wp_localize_script( 'hood-script', 'hood_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
}
add_action( 'wp_enqueue_scripts', 'hood_theme_scripts' );
// Woocommerce
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
function my_theme_wrapper_start() {
echo '<section id="main">';
}
function my_theme_wrapper_end() {
echo '</section>';
}
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
add_theme_support( 'woocommerce' );
}
/**
* Set the content width in pixels, based on the theme's design and stylesheet.
*
* Priority 0 to make it available to lower priority callbacks.
*
* @global int $content_width
*/



 function hood_admin_scripts_styles() {
        wp_enqueue_script( 'hood-admin', get_template_directory_uri() . '/includes/custom-menu/js/admin-scripts.js', array('jquery'), '', true);
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'jquery-ui-spinner' );
        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_media();

        return;
    }
    add_action('admin_enqueue_scripts','hood_admin_scripts_styles');


function hood_theme_content_width() {
$GLOBALS['content_width'] = apply_filters( 'hood_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'hood_theme_content_width', 0 );
/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/
function hood_theme_widgets_init_first() {
register_sidebar( array(
'name'          => esc_html__( 'Default Sidebar', 'hood-theme' ),
'id'            => 'default_sidebar',
'before_widget' => '<aside id="%1$s" class="c-layout-sidebars-1"><div class="c-area widget %2$s">',
'after_widget'  => '</div></aside>',
'before_title'  => '<h5>',
'after_title'   => '</h5>',
) );
register_sidebar( array(
'name'          => esc_html__( 'Product Category Sidebar', 'hood-theme' ),
'id'            => 'product_category_sidebar',
'before_widget' => '<aside id="%1$s" class="c-layout-sidebars-1"><div class="c-area widget %2$s">',
'after_widget'  => '</div></aside>',
'before_title'  => '<h5>',
'after_title'   => '</h5>',
) );
register_sidebar( array(
'name'          => esc_html__( 'Product Detail Sidebar', 'hood-theme' ),
'id'            => 'product_detail_sidebar',
'before_widget' => '<aside id="%1$s" class="c-layout-sidebars-1"><div class="c-area widget %2$s">',
'after_widget'  => '</div></aside>',
'before_title'  => '<h5>',
'after_title'   => '</h5>',
) );
register_sidebar( array(
'name'          => esc_html__( 'Blog Sidebar', 'hood-theme' ),
'id'            => 'blog_sidebar',
'before_widget' => '<aside id="%1$s" class="c-layout-sidebars-1"><div class="c-area widget %2$s">',
'after_widget'  => '</div></aside>',
'before_title'  => '<h5>',
'after_title'   => '</h5>',
) );
register_sidebar( array(
'name'          => esc_html__( 'Footer Copyright', 'hood-theme' ),
'id'            => 'footer_copy',
'before_widget' => '',
'after_widget'  => '',
'before_title'  => '',
'after_title'   => '',
) );
register_sidebar( array(
'name'          => esc_html__( 'Footer 1', 'hood-theme' ),
'id'            => 'footer_1',
'before_widget' => '<aside id="%1$s">',
'after_widget'  => '</aside>',
'before_title'  => '<div class="c-caption">',
'after_title'   => '</div>',
) );
register_sidebar( array(
'name'          => esc_html__( 'Footer 2', 'hood-theme' ),
'id'            => 'footer_2',
'before_widget' => '<aside id="%1$s">',
'after_widget'  => '</aside>',
'before_title'  => '<div class="c-caption">',
'after_title'   => '</div>',
) );
register_sidebar( array(
'name'          => esc_html__( 'Footer 3', 'hood-theme' ),
'id'            => 'footer_3',
'before_widget' => '<aside id="%1$s">',
'after_widget'  => '</aside>',
'before_title'  => '<div class="c-caption">',
'after_title'   => '</div>',
) );
register_sidebar( array(
'name'          => esc_html__( 'Footer 4', 'hood-theme' ),
'id'            => 'footer_4',
'before_widget' => '<aside id="%1$s">',
'after_widget'  => '</aside>',
'before_title'  => '<div class="c-caption">',
'after_title'   => '</div>',
) );
}
add_action( 'widgets_init', 'hood_theme_widgets_init_first' );
/**
* Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';
/**
* Custom breadcrumbs
*/
require get_template_directory() . '/inc/breadcrumbs.php';
/**
* Get Theme Functions
*/
require get_template_directory() . '/inc/hood-functions.php';

require get_template_directory() . '/includes/custom-menu/custom-menu.php';

require get_template_directory() . '/inc/plugins/tgm-init.php';
function hood_include_files($path) {
$files = glob( $path );
	if ( ! empty( $files ) ) {
		foreach ( $files as $file ) {
		   include $file;
		}
	}
}

add_filter( 'woocommerce_product_subcategories_hide_empty', '__return_true');

function custom_excerpt_length( $length ) {
	return 35; 
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_filter( 'wpcf7_validate_configuration', '__return_false' );

/**
 * @snippet       WooCommerce: Redirect to Custom Thank you Page
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=490
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 2.5.5
 */
 
// Redirect custom thank you
 
add_action( 'woocommerce_thankyou', 'bbloomer_redirectcustom');
 
function bbloomer_redirectcustom( $order_id ){
    $order = new WC_Order( $order_id );
	$url = ''.site_url().'/thank-you/';
	/* $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => get_current_user_id(),
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_order_statuses() ),
    ) );
	$loyal_count = 2;
	if ( count( $customer_orders ) >= $loyal_count ) {
       $url = ''.site_url().'/thank-you/';
    }
	else {		
		 $url = ''.site_url().'/wp-content/uploads/2018/01/RFI-credit-application.pdf';
	}
  */
    if ( $order->status != 'failed' ) {
        wp_redirect($url);
        exit;
    }
}

$result11 = add_role(
    'user_3_40.0',
    __( 'USER 3 (40.0% Discount)'),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_11' => true,
    )
);

$result10 = add_role(
    'user_2_35.0',
    __( 'USER 2 (35.0% Discount)'),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_10' => true,
    )
);

$result9 = add_role(
    'user_1_30.0',
    __( 'USER 1 (30.0% Discount)'),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_9' => true,
    )
);

$result8 = add_role(
    'dist_2_52.5',
    __( 'DIST 2 (52.5% Discount)'),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_8' => true,
    )
);

$result7 = add_role(
    'dist_1_50.0',
    __( 'DIST 1 (50.0% Discount)'),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_7' => true,
    )
);

$result6 = add_role(
    'resale_4_52.5',
    __( 'RESALE 4 (52.5% Discount)'),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_6' => true,
    )
);

$result5 = add_role(
    'resale_3_50.0',
    __( 'RESALE 3 (50.0% Discount)'),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_5' => true,
    )
);

$result4 = add_role(
    'resale_2_47.5',
    __( 'RESALE 2 (47.5% Discount)'),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_4' => true,
    )
);

$result3 = add_role(
    'resale_1_45.0',
    __( 'RESALE 1 (45.0% Discount)' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_3' => true,
    )
);

$result2 = add_role(
    'oem_3_55.0',
    __( 'OEM 3 (55.0% Discount)' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_2' => true,
    )
);

$result1 = add_role(
    'oem_2_52.5',
    __( 'OEM 2 (52.5% Discount)' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_1' => true,
    )
);

$result = add_role(
    'oem_1_50.0',
    __( 'OEM 1 (50.0% Discount)' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
		'level_0' => true,
    )
);

/* $result12 = add_role(
    'X10DR_Pricing',
    __( 'X10DR Pricing'),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
); */
add_filter('woocommerce_get_price','change_price', 10, 2);

function change_price($price, $productd){
	$user = wp_get_current_user();
	$role = ( array ) $user->roles;
	$userrole = $role[0];
	$exuserinfo = explode("_",$userrole);
	$discountVal = $exuserinfo[2];
	$variable = get_field('x10dr_pricing', 'user_'.$user->ID);	$product_cats = array( 'installation_accessories', 'spare_rado_interface_adaptors' );
	if(($productd->id == '12015') || has_term( $product_cats, 'product_cat', $productd->id )){
		if($variable == 25){
			$price = ($price - ($price*$variable/100));
		}
		else if($variable == 'full_price'){
			$price = $price;
		}		
		else {
			$price = ($price - ($price*$discountVal/100));
		}
	 }
	 elseif(($productd->id != '12015') || !has_term( $product_cats, 'product_cat', $product_id )&&(($userrole == 'oem_1_50.0')||($userrole == 'oem_2_52.5')||($userrole == 'oem_3_55.0')||($userrole == 'resale_1_45.0')||($userrole == 'resale_2_47.5')||($userrole == 'resale_3_50.0')||($userrole == 'resale_4_52.5')||($userrole == 'dist_1_50.0')||($userrole == 'dist_2_52.5')||($userrole == 'user_1_30.0')||($userrole == 'user_2_35.0')||($userrole == 'user_3_40.0'))){
		 $price = ($price - ($price*$discountVal/100));
	 }else{
		 $price = $price;
	 }
	return $price;
}

add_filter( 'woocommerce_checkout_fields', 'webendev_woocommerce_checkout_fields' );
function webendev_woocommerce_checkout_fields( $fields ) {
	$fields['order']['order_comments']['placeholder'] = 'Special delivery instructions, order notes.';
	return $fields;
}

/* add_action( 'admin_init', 'clean_unwanted_caps' );
function clean_unwanted_caps(){
	$delete_caps = array('edit_issues', 'publish_issues', 'edit_other_issues', 'read_private_issues',
		'delete_issue', 'edit_issue');
	global $wp_roles;
	foreach ($delete_caps as $cap) {
		foreach (array_keys($wp_roles->roles) as $role) {
			$wp_roles->remove_cap($role, $cap);
		}
	}
} */

add_filter( 'woocommerce_product_tabs', 'conditionaly_removing_product_tabs', 99 );
function conditionaly_removing_product_tabs( $tabs ) {

    // Get the global product object
    global $product;

    // Get the current product ID
    $product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;

    // Define HERE your targeted categories (Ids, slugs or names)   <===  <===  <===
    $product_cats = array( 'installation_accessories', 'spare_rado_interface_adaptors' );

    // If the current product have the same ID than one of the defined IDs in your array,… 
    // we remove the tab.
    if( has_term( $product_cats, 'product_cat', $product_id ) ){
		add_filter('woocommerce_get_price','change_price', 10, 2);	
        // KEEP BELOW ONLY THE TABS YOU NEED TO REMOVE   <===  <===  <===  <===
        unset( $tabs['pdfs'] ); // (Description tab)  
        unset( $tabs['shippginspecification'] );     // (Reviews tab)
        unset( $tabs['question'] ); // (Additional information tab)		unset( $tabs['details'] ); // (Additional information tab)		unset( $tabs['specifications'] ); // (Additional information tab)		unset( $tabs['videosimage'] ); // (Additional information tab)
    }


	$pdfdata = get_field('pdfsdownloads', $product->id);
	if($pdfdata == '')
	{
		unset( $tabs['pdfs'] ); // (Description tab)  
	}
    return $tabs;	
}


function wt_get_category_count($input = '') {
	global $wpdb;
	if($input == '')
	{
		$category = get_the_category();
		return $category[0]->category_count;
	}
	elseif(is_numeric($input))
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
		return $wpdb->get_var($SQL);
	}
	else
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
		return $wpdb->get_var($SQL);
	}
}


function yourtheme_woocommerce_image_dimensions() {
 
	$catalog = array(
		'width' 	=> '180',	// px
		'height'	=> '180',	// px
		'crop'		=> 1 		// true
	);
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs

}
add_action( 'after_switch_theme', 'yourtheme_woocommerce_image_dimensions', 1 );


function wp_numeric_pagination($max_num_pages) {
global $wp_query;

$big = 999999999;
$search_for   = array( $big, '#038;' );
$replace_with = array( '%#%', '' );
$tag = '<div class="pagination">' . PHP_EOL;
$tag .= paginate_links( array(
        'base'              => str_replace( $search_for, $replace_with, esc_url( get_pagenum_link( $big ) ) ),
        'format'            => '?paged=%#%',
        'current'           => max( 1, get_query_var('paged') ),
        'total'             => $max_num_pages,
        'prev_next'         => True,
        'prev_text'         => __('«'),
        'next_text'         => __('»'),
        'before_page_number' => '<span>',
        'after_page_number'  => '</span>'
    ) ) . PHP_EOL;

$tag .= '</div>' . PHP_EOL;
echo $tag;
}

add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
}

add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}


// if(is_user_logged_in())
// {
	// add_filter('woocommerce_cart_needs_payment', '__return_false');
// }

// define the woocommerce_before_checkout_process callback 
function action_woocommerce_before_checkout_process( $array ) { 
	// make action magic happen here... 
	if(isset($_POST['disable_payment']) && ($_POST['disable_payment'] == 1))
	{
		add_filter('woocommerce_cart_needs_payment', '__return_false');
	}
}; 
		 
// add the action 
add_action( 'woocommerce_before_checkout_process', 'action_woocommerce_before_checkout_process', 10, 1 ); 


///// recent posts shortcode
function recent_posts_func( $atts ){
	$atts = shortcode_atts( array(
			'items' => '3',
			'cat' => '',
			'show' => ''
		), $atts, 'recent_posts');
	
	$args = array(
		'post_type' => 'post', 
		'posts_per_page' => $atts['items']
	);

	if($atts['cat'] != '')
	{
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $atts['cat'],
			),
		);
	}
	
	/////
	$recent_posts = new WP_Query($args);
	$response='<ul class="wid_recent_posts widget_recent_entries">';
	while( $recent_posts->have_posts() ) :  
		$recent_posts->the_post();
		$ttl = get_the_title();
		$title = strlen($ttl) > 35 ? substr($ttl,0,35)."..." : $ttl;
		$response.='<li>
			<div class="img_part">
				<a href="'.get_permalink().'" title="'.$ttl.'">';
					if ( has_post_thumbnail() ) {
						// $response.='<img src="'.get_the_post_thumbnail_url('thumbnail').'">';
						$response.=get_the_post_thumbnail( get_the_ID(), array( 50, 50) );
					}    
				$response.='</a>
			</div>
			<div class="ttl_part">
				<a href="'.get_permalink().'" title="'.$ttl.'"><h4>'.$title.'</h4></a>
			</div>
			<div class="clr"></div>';
		$response.='</li>';
	endwhile;
	$response.='</ul>';
	/////	
	wp_reset_query();
	return $response;
	wp_reset_postdata(); # reset post data so that other queries/loops work	
}
add_shortcode('recent_posts', 'recent_posts_func');

// custom image size for front and rear view images
add_image_size( "front_rear_view_img", "250", 9999, false);

function front_rear_products_arr()
{
 return $front_rear_img_cats = array(10844,10846,10845,10823,10825,10826,10827,10829,10830,10832,10833,10834,10835,10838,10828,10973);
}

function western_custom_buy_buttons(){
	$product = get_product();

	if ( has_term( 'x10dr-lite', 'product_cat') ){

		// removing the purchase buttons
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
		remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
		remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
		remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
	}
}

add_action( 'wp', 'western_custom_buy_buttons' );


remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart');
add_action( 'woocommerce_after_shop_loop_item', 'replace_add_to_cart', 15 );
add_action( 'woocommerce_single_product_summary', 'replace_add_to_cart', 25 );

function replace_add_to_cart() {
   echo '<b>Call or email RFI to place an order at <a href="tel:3304860706">(330) 486-0706</a> or <a href="mailto:sales@rfiamericas.com">sales@rfiamericas.com</a></b>';
}




// 1. Prevent Prices from Rendering in Page HTML for Logged-Out Users
add_filter('woocommerce_get_price_html', 'hide_price_for_guests', 99, 2);
function hide_price_for_guests($price, $product) {
    if (!is_user_logged_in()) {
        return ''; // Or return 'Login to see price'
    }
    return $price;
}


// 2. Disable Structured Data for Prices (Schema.org)
add_filter('woocommerce_structured_data_product', 'remove_price_schema_for_guests', 20, 2);
function remove_price_schema_for_guests($markup, $product) {
    if (!is_user_logged_in()) {
        unset($markup['offers']);
    }
    return $markup;
}

