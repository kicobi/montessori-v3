<?php

/**
 * Workstation Pro.
 *
 * This file adds the functions to the Workstation Pro Theme.
 *
 * @package Workstation
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/workstation/
 */

// Start the engine.
include_once(get_template_directory() . '/lib/init.php');

// Setup Theme.
include_once(get_stylesheet_directory() . '/lib/theme-defaults.php');

// Set Localization (do not remove).
add_action('after_setup_theme', 'workstation_localization_setup');
function workstation_localization_setup()
{
	load_child_theme_textdomain('workstation-pro', get_stylesheet_directory() . '/languages');
}

// Add the theme helper functions.
include_once(get_stylesheet_directory() . '/lib/helper-functions.php');

// Add Image upload and Color select to WordPress Theme Customizer.
require_once(get_stylesheet_directory() . '/lib/customize.php');

// Include Customizer CSS.
include_once(get_stylesheet_directory() . '/lib/output.php');

// Include WooCommerce support.
include_once(get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php');

// Include the WooCommerce styles and the Customizer CSS.
include_once(get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php');

// Include notice to install Genesis Connect for WooCommerce.
include_once(get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php');

// Child theme (do not remove).
define('CHILD_THEME_NAME', __('Workstation Pro', 'workstation-pro'));
define('CHILD_THEME_URL', 'http://my.studiopress.com/themes/workstation/');
define('CHILD_THEME_VERSION', '1.1.3');

// Enqueue scripts and styles.
add_action('wp_enqueue_scripts', 'workstation_enqueue_scripts_styles');
function workstation_enqueue_scripts_styles()
{
	wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Lato:400italic,700italic,700,400', array(), CHILD_THEME_VERSION);
	wp_enqueue_style('dashicons');

	$suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
	wp_enqueue_script('workstation-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', array('jquery'), CHILD_THEME_VERSION, true);
	wp_localize_script(
		'workstation-responsive-menu',
		'genesis_responsive_menu',
		workstation_responsive_menu_settings()
	);
}

// Setup our responsive menu settings.
function workstation_responsive_menu_settings()
{

	$settings = array(
		'mainMenu'    => __('Menu', 'workstation-pro'),
		'subMenu'     => __('Submenu', 'workstation-pro'),
		'menuClasses' => array(
			'combine' => array(
				'.nav-secondary',
				'.nav-primary',
			),
		),
	);

	return $settings;
}

// Add HTML5 markup structure.
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

// Add accessibility support.
add_theme_support('genesis-accessibility', array('404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links'));

// Add viewport meta tag for mobile browsers.
add_theme_support('genesis-responsive-viewport');

// Add support for custom header.
add_theme_support('custom-header', array(
	'flex-height'     => true,
	'width'           => 600,
	'height'          => 120,
	'header-selector' => '.site-title a',
	'header-text'     => false,
));

// Add support for structural wraps.
add_theme_support('genesis-structural-wraps', array(
	'header',
	'footer',
));

// Add support for after entry widget.
add_theme_support('genesis-after-entry-widget-area');

// Add image sizes.
add_image_size('featured-content-lg', 1200, 600, TRUE);
add_image_size('featured-content-sm', 600, 400, TRUE);

// Unregister layout settings.
genesis_unregister_layout('content-sidebar-sidebar');
genesis_unregister_layout('sidebar-content-sidebar');
genesis_unregister_layout('sidebar-sidebar-content');

// Unregister secondary sidebar.
unregister_sidebar('sidebar-alt');

// Unregister the header right widget area.
unregister_sidebar('header-right');

// Rename Primary Menu.
add_theme_support('genesis-menus', array('secondary' => __('Before Header Menu', 'workstation-pro'), 'primary' => __('Header Menu', 'workstation-pro')));

// Remove output of primary navigation right extras.
remove_filter('genesis_nav_items', 'genesis_nav_right', 10, 2);
remove_filter('wp_nav_menu_items', 'genesis_nav_right', 10, 2);

// Remove navigation meta box.
add_action('genesis_theme_settings_metaboxes', 'workstation_remove_genesis_metaboxes');
function workstation_remove_genesis_metaboxes($_genesis_theme_settings_pagehook)
{
	remove_meta_box('genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main');
}

// Reposition the navigation.
remove_action('genesis_after_header', 'genesis_do_nav');
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_before_header', 'genesis_do_subnav');
add_action('genesis_header', 'genesis_do_nav', 5);

// Remove skip link for primary navigation and add skip link for footer widgets.
add_filter('genesis_skip_links_output', 'workstation_skip_links_output');
function workstation_skip_links_output($links)
{

	if (isset($links['genesis-nav-primary'])) {
		unset($links['genesis-nav-primary']);
	}

	$new_links = $links;
	array_splice($new_links, 3);

	if (is_active_sidebar('flex-footer')) {
		$new_links['footer'] = __('Skip to footer', 'workstation-pro');
	}

	return array_merge($new_links, $links);
}

// Reposition the entry meta in the entry header.
remove_action('genesis_entry_header', 'genesis_post_info', 12);
add_action('genesis_entry_header', 'genesis_post_info', 8);

// Reposition the entry image.
remove_action('genesis_entry_content', 'genesis_do_post_image', 8);
add_action('genesis_entry_header', 'genesis_do_post_image', 5);

// Add Excerpt support to Pages.
add_post_type_support('page', 'excerpt');

// Output Excerpt on Pages.
add_action('genesis_meta', 'workstation_page_description_meta');
function workstation_page_description_meta()
{

	if (is_front_page()) {
		remove_action('genesis_site_description', 'genesis_seo_site_description');
		add_action('genesis_after_header', 'workstation_open_after_header', 5);
		add_action('genesis_after_header', 'genesis_seo_site_description', 10);
		add_action('genesis_after_header', 'workstation_close_after_header', 15);
	}

	if (is_archive() && !is_post_type_archive()) {
		remove_action('genesis_before_loop', 'genesis_do_taxonomy_title_description', 15);
		add_action('genesis_after_header', 'workstation_open_after_header', 5);
		add_action('genesis_after_header', 'genesis_do_taxonomy_title_description', 10);
		add_action('genesis_after_header', 'workstation_close_after_header', 15);
	}

	if (is_post_type_archive() && genesis_has_post_type_archive_support()) {
		remove_action('genesis_before_loop', 'genesis_do_cpt_archive_title_description');
		add_action('genesis_after_header', 'workstation_open_after_header', 5);
		add_action('genesis_after_header', 'genesis_do_cpt_archive_title_description', 10);
		add_action('genesis_after_header', 'workstation_close_after_header', 15);
	}

	if (is_author()) {
		remove_action('genesis_before_loop', 'genesis_do_author_title_description', 15);
		add_action('genesis_after_header', 'workstation_open_after_header', 5);
		add_action('genesis_after_header', 'genesis_do_author_title_description', 10);
		add_action('genesis_after_header', 'workstation_close_after_header', 15);
	}

	if (is_page_template('page_blog.php') && has_excerpt()) {
		remove_action('genesis_before_loop', 'genesis_do_blog_template_heading');
		add_action('genesis_after_header', 'workstation_open_after_header', 5);
		add_action('genesis_after_header', 'workstation_add_page_description', 10);
		add_action('genesis_after_header', 'workstation_close_after_header', 15);
	} elseif (is_singular() && is_page() && has_excerpt()) {
		remove_action('genesis_entry_header', 'genesis_do_post_title');
		add_action('genesis_after_header', 'workstation_open_after_header', 5);
		add_action('genesis_after_header', 'workstation_add_page_description', 10);
		add_action('genesis_after_header', 'workstation_close_after_header', 15);
	}
}

// Output the page title and description.
function workstation_add_page_description()
{

	echo '<div class="page-description">';
	echo '<h1 itemprop="headline" class="page-title">' . get_the_title() . '</h1>';
	echo '<p>' . get_the_excerpt() . '</p></div>';
}

// Output the after header wrap div.
function workstation_open_after_header()
{
	echo '<div class="after-header"><div class="wrap">';
}

// Output the after header wrap div closing tags.
function workstation_close_after_header()
{
	echo '</div></div>';
}

// Setup widget counts.
function workstation_count_widgets($id)
{

	$sidebars_widgets = wp_get_sidebars_widgets();

	if (isset($sidebars_widgets[$id])) {
		return count($sidebars_widgets[$id]);
	}
}

// Get the class string for a flexible widget.
function workstation_widget_area_class($id)
{

	$count = workstation_count_widgets($id);

	$class = '';

	if ($count == 1) {
		$class .= ' widget-full';
	} elseif ($count % 3 == 1) {
		$class .= ' widget-thirds';
	} elseif ($count % 4 == 1) {
		$class .= ' widget-fourths';
	} elseif ($count % 6 == 0) {
		$class .= ' widget-uneven';
	} elseif ($count % 2 == 0) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;
}

// Add the flexible footer widget area.
add_action('genesis_before_footer', 'workstation_footer_widgets');
function workstation_footer_widgets()
{

	genesis_widget_area('flex-footer', array(
		'before' => '<div id="footer" class="flex-footer footer-widgets"><h2 class="genesis-sidebar-title screen-reader-text">' . __('Footer', 'workstation-pro') . '</h2><div class="flexible-widgets widget-area wrap' . workstation_widget_area_class('flex-footer') . '">',
		'after'  => '</div></div>',
	));
}

// Register widget areas.
genesis_register_sidebar(array(
	'id'          => 'front-page-1',
	'name'        => __('Front Page 1', 'workstation-pro'),
	'description' => __('This is the front page 1 section.', 'workstation-pro'),
));
genesis_register_sidebar(array(
	'id'          => 'front-page-2',
	'name'        => __('Front Page 2', 'workstation-pro'),
	'description' => __('This is the front page 2 section.', 'workstation-pro'),
));
genesis_register_sidebar(array(
	'id'          => 'front-page-3',
	'name'        => __('Front Page 3', 'workstation-pro'),
	'description' => __('This is the front page 3 section.', 'workstation-pro'),
));
genesis_register_sidebar(array(
	'id'          => 'front-page-4',
	'name'        => __('Front Page 4', 'workstation-pro'),
	'description' => __('This is the front page 4 section.', 'workstation-pro'),
));
genesis_register_sidebar(array(
	'id'          => 'flex-footer',
	'name'        => __('Flexible Footer', 'workstation-pro'),
	'description' => __('This is the footer section.', 'workstation-pro'),
));


// ------------------------------------------------------------------------------------
// Customization begins here.
// ------------------------------------------------------------------------------------


/**
 * Remove unused Genesis metaboxes
 *
 */

// Remove Genesis in-post SEO Settings
remove_action('admin_menu', 'genesis_add_inpost_seo_box');

// Remove Genesis Layout Settings
remove_theme_support('genesis-inpost-layouts');

// Remove Genesis SEO Settings menu link
remove_theme_support('genesis-seo-settings-menu');

// Remove Genesis Scripts Meta box on pages
add_action('admin_menu', 'remove_genesis_page_scripts_box');
function remove_genesis_page_scripts_box()
{
	remove_meta_box('genesis_inpost_scripts_box', 'page', 'normal');
}

// add_filter('genesis_customizer_theme_settings_config', 'genesis_sample_remove_customizer_settings');


/**
 *  Remove default sidebar
 * 
 */
remove_action('genesis_sidebar', 'genesis_do_sidebar');


/**
 * Remove Edit Link from pages
 * 
 */
add_filter('edit_post_link', '__return_false');


/**
 * Add footer menu
 * 
 */

function mont_footer_menu()
{
	register_nav_menu('mont-footer-menu', __('Sidfoten'));
}
add_action('init', 'mont_footer_menu');


/**
 * Customize the footer
 * 
 */

remove_action('genesis_footer', 'genesis_do_footer');
add_action('genesis_footer', 'mont_custom_footer');
function mont_custom_footer()
{

	echo '<h3>Skärgårdens Montessoriförskola</h3>';

	echo '<div class="footer-flex-row">';

	// Custom fields from Inställningar options panel
	echo '<p class="footer-flex-row-item">' . get_field('adress', 'option') . '</p><br />';

	echo '<p class="footer-flex-row-item">';
	if (have_rows('telefonnummer', 'option')) :
		while (have_rows('telefonnummer', 'option')) : the_row();
			$label = get_sub_field('etikett') . ' ';
			$number = get_sub_field('telnr');
			echo $label . ' <a href="tel:' . $number . '">' . $number . '</a><br />';
		endwhile;
	endif;
	echo '‬</p>';

	echo '<div class="footer-flex-row-item">';
	wp_nav_menu(array(
		'menu'           => 'Sidfoten',
		'fallback_cb'    => false // Do not fall back to wp_page_menu()
	));
	echo '</div><br />';

	echo '<p class="footer-flex-row-item"><a href="' . get_field('facebook', 'option') . '">Facebook</a></p>';

	echo '</div>';
}


/**
 * Restrict content based on URI segment 
 * 
 */

add_action('genesis_before', 'restrict_content');

// Check if user is logged in when accessing /kunskapsbas
function restrict_content()
{
	// Get the URL segments
	$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

	// Check the first segment
	if ($uriSegments[1] == 'kunskapsbas') {

		// Check if user is logged in
		if (!is_user_logged_in()) {

			// User is not logged in. Meta refresh and redirect to login modal 
			echo '<meta http-equiv = "refresh" content = "0; url = /#login" />';

			// Prevent page content from loading 
			exit();
		} else {
			// User is logged in; do nothing.
		}
	}
}


/**
 * Create child pages navigation in sidebar. 
 * List is added before the sidebar widget area.
 *
 */

add_action('genesis_before_sidebar_widget_area', 'mont_list_child_pages', 5);

function mont_list_child_pages()
{

	global $post; // global variable $post

	if (is_page() && $post->post_parent) {
		$children = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0');
	} else {
		$children = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0');
	}
	if ($children) {
		echo '<ul class="subpage_nav">';
		echo $children;
		echo '</ul>';
	}
}


// /**
//  * Automatically add child pages to nav
//  * auto_child_page_menu
//  * 
//  */

// class auto_child_page_menu
// {
// 	/**
// 	 * class constructor
// 	 * @author Ohad Raz <admin@bainternet.info>
// 	 * @param   array $args
// 	 * @return  void
// 	 */
// 	public function __construct($args = array())
// 	{
// 		add_filter('wp_nav_menu_objects', array($this, 'on_the_fly'));
// 	}
// 	/**
// 	 * the magic function that adds the child pages
// 	 * @author Ohad Raz <admin@bainternet.info>
// 	 * @param  array $items
// 	 * @return array
// 	 */
// 	public function on_the_fly($items)
// 	{
// 		global $post;
// 		$tmp = array();
// 		foreach ($items as $key => $i) {
// 			$tmp[] = $i;
// 			//if not page move on
// 			if ($i->object != 'page') {
// 				continue;
// 			}
// 			$page = get_post($i->object_id);
// 			//if not parent page move on
// 			if (!isset($page->post_parent) || $page->post_parent != 0) {
// 				continue;
// 			}
// 			$children = get_pages(array('child_of' => $i->object_id, 'sort_column' => 'menu_order'));
// 			foreach ((array) $children as $c) {
// 				//set parent menu
// 				$c->menu_item_parent      = $i->ID;
// 				$c->object_id             = $c->ID;
// 				$c->object                = 'page';
// 				$c->type                  = 'post_type';
// 				$c->type_label            = 'Page';
// 				$c->url                   = get_permalink($c->ID);
// 				$c->title                 = $c->post_title;
// 				$c->target                = '';
// 				$c->attr_title            = '';
// 				$c->description           = '';
// 				$c->classes               = array('', 'menu-item', 'menu-item-type-post_type', 'menu-item-object-page');
// 				$c->xfn                   = '';
// 				$c->current               = ($post->ID == $c->ID) ? true : false;
// 				$c->current_item_ancestor = ($post->ID == $c->post_parent) ? true : false; //probbably not right
// 				$c->current_item_parent   = ($post->ID == $c->post_parent) ? true : false;
// 				$tmp[] = $c;
// 			}
// 		}
// 		return $tmp;
// 	}
// }
// new auto_child_page_menu();


/**
 * Create custom post type: Matsedel
 *
 */

function matsedel_init()
{
	register_post_type(
		'matsedel',
		array(
			'labels' => array(
				'name' => __('Matsedlar'),
				'singular_name' => __('Matsedel')
			),
			'public' => true,
			'has_archive' => false,
			'query_var' => true,
		)
	);
}
add_action('init', 'matsedel_init');
