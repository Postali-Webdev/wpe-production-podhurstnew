<?php
/**
 * Theme functions.
 *
 * @package Postali Parent
 * @author Postali LLC
 */

 // debug logging function
if (!function_exists('write_log')) {
    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

// Adding Custom Post Types
require_once dirname( __FILE__ ) . '/includes/landmark-cases-cpt.php'; // Custom Post Type Case Results
require_once dirname( __FILE__ ) . '/includes/testimonials-cpt.php'; // Custom Post Type Testimonials
require_once dirname( __FILE__ ) . '/includes/attorneys-cpt.php'; // Custom Post Type Attorneys
require_once dirname( __FILE__ ) . '/includes/demo-layouts-cpt.php'; // Custom Post Type Demo Layouts


add_theme_support( 'post-thumbnails' );


// Enqueue scripts
function postali_parent_scripts() {
    // Adding parent styles
    wp_enqueue_style( 'parent-stylesheet', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'parent-styles', get_template_directory_uri() . '/assets/css/styles.css');

    // Adding parent block styles
    wp_enqueue_style( 'parent-blocks-stylesheet', get_template_directory_uri() . '/blocks/assets/css/styles.css' );
    
    // Adding Parent JS
    wp_register_script('parent-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js',array('jquery'), null, true); 
    wp_enqueue_script('parent-scripts');

    // Add project specific icomoon library here
    wp_register_style( 'icomoon', 'https://cdn.icomoon.io/152819/Podhurst/style.css?629y9l', array() );
    wp_enqueue_style('icomoon');

    // Fonts
    wp_register_style( 'google-font-playfair', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap' );
    wp_enqueue_style('google-font-playfair');
    
    wp_register_style( 'google-font-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap' );
    wp_enqueue_style('google-font-roboto');
    
    wp_register_style( 'google-font-bellefair', 'https://fonts.googleapis.com/css2?family=Bellefair&display=swap' );
    wp_enqueue_style('google-font-bellefair');

    // Add slick library
    wp_register_script('slick-scripts', get_template_directory_uri() . '/assets/js/slick.min.js',array('jquery'), null, true); 
    wp_enqueue_script('slick-scripts');
    wp_register_script('slick-custom', get_template_directory_uri() . '/assets/js/slick-custom.min.js',array('jquery'), null, true); 
    wp_enqueue_script('slick-custom');
    wp_enqueue_style( 'slick-styles', get_template_directory_uri() . '/assets/css/slick.css'); // Enqueue Parent theme styles.css   

    //Register Block Scripts
    wp_register_script('accordion-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/accordions.min.js',array('jquery'), null, true);
    wp_register_script('accordion-horizontal-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/accordions-horizontal.min.js',array('jquery'), null, true);
    wp_register_script('results-scroller-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/results-scroller.min.js',array('jquery'), null, true);
    wp_register_script('process-slider-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/process-slider.min.js',array('jquery'), null, true);
    wp_register_script('tab-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/tabs.min.js',array('jquery'), null, true);
    wp_register_script('video-block-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/video-block.min.js',array('jquery'), null, true);
    wp_register_script('awards-slider-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/awards-slider.min.js',array('jquery'), null, true);
    wp_register_script('countup-custom', get_stylesheet_directory_uri() . '/blocks/assets/js/countup-custom.min.js',array('jquery'), null, true);
    wp_register_script('countup-scripts', get_stylesheet_directory_uri() . '/assets/js/jquery.countup.min.js',array('jquery'), null, true); 
    wp_register_script('waypoints-scripts', get_stylesheet_directory_uri() . '/assets/js/jquery.waypoints.min.js',array('jquery'), null, true); 
    wp_register_script('banner-carousel', get_stylesheet_directory_uri() . '/blocks/assets/js/banner-carousel.min.js',array('jquery'), null, true); 
    wp_register_script('testimonials-scroller-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/testimonials-scroller.min.js',array('jquery'), null, true); 
    wp_register_script('links-scroller-scripts', get_stylesheet_directory_uri() . '/blocks/assets/js/links-scroller.min.js',array('jquery'), null, true); 
    wp_register_script('cases-filter-scripts', get_stylesheet_directory_uri() . '/assets/js/landmark-cases-filter-script.min.js',array('jquery'), null, true); 
}
add_action('wp_enqueue_scripts', 'postali_parent_scripts');

// Enqueue custom scripts for specific blocks
function enqueue_custom_block_assets() {
    if ( has_block( 'acf/counter-group' ) ) {
          wp_enqueue_script('waypoints-scripts');
          wp_enqueue_script('countup-scripts');
          wp_enqueue_script('countup-custom');
    }
    if ( has_block( 'acf/accordion' ) ) {
        wp_enqueue_script('accordion-scripts');
    }
    if ( has_block( 'acf/accordion-horizontal' ) ) {
        wp_enqueue_script('accordion-horizontal-scripts');
    }
    if ( has_block( 'acf/results-scroller' ) || is_page_template('landmark-cases-page.php') || is_home() ) {
        wp_enqueue_script('results-scroller-scripts');
    }
    if ( has_block( 'acf/slider-process' ) ) {
        wp_enqueue_script('process-slider-scripts');
    }
    if ( has_block( 'acf/tabs' ) ) {
        wp_enqueue_script('tab-scripts');
    }
    if ( has_block( 'acf/video-block' ) || has_block( 'acf/large-video-embed' ) ) {
        wp_enqueue_script('video-block-scripts');
    }
    if ( has_block( 'acf/awards' ) ) {
        wp_enqueue_script('awards-slider-scripts');
    }
    if ( has_block( 'acf/banner-block' ) ) {
        wp_enqueue_script('banner-carousel');
    }
    if ( has_block( 'acf/testimonials-block' ) || is_page_template('testimonials-page.php') ) {
        wp_enqueue_script('testimonials-scroller-scripts');
    }
    if ( has_block( 'acf/links' ) ) {
        wp_enqueue_script('links-scroller-scripts');
    }
    if ( is_page_template('landmark-cases-page.php') ) {
        wp_enqueue_script('cases-filter-scripts');
    }
}
add_action( 'enqueue_block_assets', 'enqueue_custom_block_assets' );


// Register Site Navigations
function postali_parent_register_nav_menus() {
    register_nav_menus(
        array(
            'header-nav' => __( 'Header Navigation', 'postali' ),
            'footer-nav' => __( 'Footer Navigation', 'postali' ),
            'practice-areas-nav' => __( 'Pratice Areas Navigation', 'postali' ),
        )
    );
}
add_action( 'init', 'postali_parent_register_nav_menus' );


// Add required options pages
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Global Schema',
        'menu_title'    => 'Global Schema',
        'menu_slug'     => 'global-schema',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-networking', // Add this line and replace the second inverted commas with class of the icon you like
        'redirect'      => false
    ));
    
    acf_add_options_page(array(
        'page_title'    => 'Awards',
        'menu_title'    => 'Awards',
        'menu_slug'     => 'awards',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-awards',
        'redirect'      => false
    ));

    acf_add_options_page(array(
        'page_title'    => 'Site Customizations',
        'menu_title'    => 'Site Customizations',
        'menu_slug'     => 'site-customizations',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-admin-generic',
        'redirect'      => false
    ));
}

// Add required ACF fields for options pages
function parent_crest_acf_options_fields() {
    acf_add_local_field_group(array(
        'key' => 'group_5a9b9b0b9e9b6',
        'title' => 'Global Schema',
        'fields' => array (
            array (
                'key' => 'field_5a9b9b0b9e9b7',
                'label' => 'Global Schema',
                'name' => 'global_schema',
                'type' => 'textarea',
                'instructions' => '<strong>Do not</strong> include script tags. They will be added automatically.'
            )
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'global-schema'
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'parent_crest_acf_options_fields');

// Add ability to add SVG to Wordpress Media Library
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


// Add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


// Enable upload for webp image files
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');


// Enable preview / thumbnail for webp image files.
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );
        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }
    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);


// Display Current Year as shortcode - [year]
function year_shortcode () {
    $year = date_i18n ('Y');
    return $year;
}
add_shortcode ('year', 'year_shortcode');


// WP Backend Menu area taller
add_action('admin_head', 'taller_menus');
function taller_menus() {
    echo '<style>
        .posttypediv div.tabs-panel {
            max-height:500px !important;
        }
    </style>';
}


// Add Search Bar to Top Nav
function mainmenu_navsearch($items, $args) {
    if ($args->theme_location == 'header-nav') {
        ob_start();
        ?>
        <li class="menu-item menu-item-search search-holder">
            <form class="navbar-form-search" role="search" method="get" action="/">
                <div class="search-form-container hdn" id="search-input-container">
                    <div class="search-input-group">
                        <div class="form-group">
                            <input type="text" name="s" placeholder="Search for..." id="search-input-5cab7fd94d469" value="" class="form-control">
                            <label for="s">search for... </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-search" id="search-button"><span class="icon-search-icon" aria-hidden="true"></span></button>
            </form>	
        </li>

        <?php
        $new_items = ob_get_clean();

        $items .= $new_items;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'mainmenu_navsearch', 10, 2);


// Add template column to page list in wp-admin
function page_column_views( $defaults ) {
    $defaults['page-layout'] = __('Template');
    return $defaults;
}
add_filter( 'manage_pages_columns', 'page_column_views' );

function page_custom_column_views( $column_name, $id ) {
    if ( $column_name === 'page-layout' ) {
        $set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
        if ( $set_template == 'default' ) {
            echo 'Default';
        }
        $templates = get_page_templates();
        ksort( $templates );
        foreach ( array_keys( $templates ) as $template ) :
            if ( $set_template == $templates[$template] ) echo $template;
        endforeach;
    }
}
add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );


// debug logging function
if (!function_exists('write_log')) {
    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}

add_filter( 'block_categories_all' , function( $categories ) {
    // Adding a new category.
	$categories[] = array(
		'slug'  => 'postali-blocks',
		'title' => 'Postali Crest Blocks'
	);
	return $categories;
} );


/* ACF Register Blocks */
function postali_crest_register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/accordions' );
    register_block_type( __DIR__ . '/blocks/accordions-horizontal' );
    register_block_type( __DIR__ . '/blocks/attorneys-block' );
    register_block_type( __DIR__ . '/blocks/awards-block' );
    register_block_type( __DIR__ . '/blocks/banner-block' );
    register_block_type( __DIR__ . '/blocks/columns' );
    register_block_type( __DIR__ . '/blocks/contact-block' );
    register_block_type( __DIR__ . '/blocks/cta-block' );
    register_block_type( __DIR__ . '/blocks/link-block' );
    register_block_type( __DIR__ . '/blocks/map-block' );
    register_block_type( __DIR__ . '/blocks/related-resources' );
    register_block_type( __DIR__ . '/blocks/results-scroller' );
    register_block_type( __DIR__ . '/blocks/slider-process' );
    register_block_type( __DIR__ . '/blocks/tabs' );
    register_block_type( __DIR__ . '/blocks/testimonials-block' );
    register_block_type( __DIR__ . '/blocks/video-block' );
    register_block_type( __DIR__ . '/blocks/large-video-block' );
    register_block_type( __DIR__ . '/blocks/theme-button' );
    register_block_type( __DIR__ . '/blocks/ordered-list-block' );
    register_block_type( __DIR__ . '/blocks/resource-cards' );
    register_block_type( __DIR__ . '/blocks/single-testimonial' );
    register_block_type( __DIR__ . '/blocks/counter-block' );
    register_block_type( __DIR__ . '/blocks/randomized-single-testimonial' );
    register_block_type( __DIR__ . '/blocks/practice-areas-block' );
    register_block_type( __DIR__ . '/blocks/single-landmark-case' );
    register_block_type( __DIR__ . '/blocks/copy-cards' );
    register_block_type( __DIR__ . '/blocks/practice-area-sections' );
}
add_action( 'init', 'postali_crest_register_acf_blocks' );

function my_allowed_block_types( $allowed_block_types, $editor_context ) {

    $allowed_blocks = [
        'core/block',
        'core/paragraph',
        'core/image',
        'core/heading',
        'core/list',
        'core/table',
        'core/columns',
        'core/column',
        'core/group',
        'core/spacer',
        'core/separator',
        'core/custom-html',
        'core/form',
        'yoast-seo/breadcrumbs',
        'acf/accordion',
        'acf/accordion-horizontal',
        'acf/attorneys-block',
        'acf/awards',
        'acf/banner-block',
        'acf/columns',
        'acf/contact',
        'acf/cta-block',
        'acf/large-video-embed',
        'acf/links',
        'acf/map',
        'acf/related',
        'acf/results-scroller',
        'acf/slider-process',
        'acf/tabs',
        'acf/testimonials-block',
        'acf/video-block',
        'acf/crest-button',
        'acf/ordered-list',
        'acf/resource-cards',
        'acf/single-testimonial',
        'acf/counter-group',
        'acf/random-testimonial',
        'acf/practice-areas',
        'acf/single-landmark-case',
        'acf/copy-cards',
        'acf/practice-area-sections',
    ];
    return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'my_allowed_block_types', 10, 2 );



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


function my_plugin_enqueue_block_editor_assets() {
	wp_enqueue_script(
		'extended-group-script',
		get_template_directory_uri() . '/assets/js/src/extended-group-script.js', // Or your plugin dir
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-compose', 'wp-hooks' ),
		null,
		true
	);

    wp_enqueue_script(
		'extended-column-script',
		get_template_directory_uri() . '/assets/js/src/extended-column-script.js', // Or your plugin dir
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-compose', 'wp-hooks' ),
		null,
		true
	);
    
    wp_enqueue_script(
		'extended-heading-script',
		get_template_directory_uri() . '/assets/js/src/extended-heading-script.js', // Or your plugin dir
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-compose', 'wp-hooks' ),
		null,
		true
	);
    
    wp_enqueue_script(
		'extended-paragraph-script',
		get_template_directory_uri() . '/assets/js/src/extended-paragraph-script.js', // Or your plugin dir
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-compose', 'wp-hooks' ),
		null,
		true
	);
    
    wp_enqueue_script(
		'extended-list-script',
		get_template_directory_uri() . '/assets/js/src/extended-list-script.js', // Or your plugin dir
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-compose', 'wp-hooks' ),
		null,
		true
	);
    
    wp_enqueue_script(
		'extended-inner-column-script',
		get_template_directory_uri() . '/assets/js/src/extended-inner-column-script.js', // Or your plugin dir
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post', 'wp-components', 'wp-element', 'wp-compose', 'wp-hooks' ),
		null,
		true
	);

    wp_enqueue_style( 'admin-stylesheet', get_template_directory_uri() . '/admin-editor-assets/css/styles.css' );
}
add_action( 'enqueue_block_editor_assets', 'my_plugin_enqueue_block_editor_assets' );


// Allows custom logo in site customization tab
add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-width' => true,
    'flex-height' => true,
) );

// Supported theme colors for Gutenberg
add_theme_support('editor-color-palette', [
  [
    'name'  => __('Red', 'textdomain'),
    'slug'  => 'red',
    'color' => '#6B221A',
  ],
  [
    'name'  => __('Orange', 'textdomain'),
    'slug'  => 'orange',
    'color' => '#8E443C',
  ],
  [
    'name'  => __('Dark Blue', 'textdomain'),
    'slug'  => 'dark-blue',
    'color' => '#2A2E40',
  ],
  [
    'name'  => __('Blue', 'textdomain'),
    'slug'  => 'blue',
    'color' => '#445594',
  ],
  [
    'name'  => __('Black', 'textdomain'),
    'slug'  => 'black',
    'color' => '#000000',
  ],
  [
    'name'  => __('White', 'textdomain'),
    'slug'  => 'white',
    'color' => '#FFFFFF',
  ]
]);

// Disable custom colors in Gutenberg
add_theme_support('disable-custom-colors');


function get_year_shortcode() {
    $date = date("Y");
    return $date;
}
add_shortcode('get_year', 'get_year_shortcode');


function add_custom_pagination_rewrite() {
    add_rewrite_rule(
        '^our-team/page/([0-9]+)/?$',
        'index.php?pagename=our-team&paged=$matches[1]',
        'top'
    );
}
add_action('init', 'add_custom_pagination_rewrite');


add_filter('wpseo_breadcrumb_links', 
function ($links) { 
    // Testimonials CPT
    if (is_singular('testimonial')) { 
        $page = get_page_by_path('testimonials'); 
        if ($page) {
            // remove Yoast CPT archive crumb if present
            foreach ($links as $i => $link) {
                if (!empty($link['ptarchive']) && $link['ptarchive'] === 'testimonial') {
                    unset($links[$i]);
                }
            }
            // insert the static page after Home
            $parent = [
                'url'  => get_permalink($page->ID),
                'text' => get_the_title($page->ID),
            ];
            $links = array_values($links);
            array_splice($links, 1, 0, [$parent]);
        }
    }

    // Landmark Cases CPT
    if (is_singular('landmark-cases')) {
        $page = get_page_by_path('landmark-cases');
        if ($page) {
            foreach ($links as $i => $link) {
                if (!empty($link['ptarchive']) && $link['ptarchive'] === 'landmark-cases') {
                    unset($links[$i]);
                }
            }
            $parent = [
                'url'  => get_permalink($page->ID),
                'text' => get_the_title($page->ID),
            ];
            $links = array_values($links);
            array_splice($links, 1, 0, [$parent]);
        }
    }

    // Attorneys CPT
    if (is_singular('attorneys')) {
        $page = get_page_by_path('our-team');
        if ($page) {
            foreach ($links as $i => $link) {
                if (!empty($link['ptarchive']) && $link['ptarchive'] === 'attorneys') {
                    unset($links[$i]);
                }
            }
            $parent = [
                'url'  => get_permalink($page->ID),
                'text' => get_the_title($page->ID),
            ];
            $links = array_values($links);
            array_splice($links, 1, 0, [$parent]);
        }
    }

    return $links;
});



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


/**
 * Disable Theme/Plugin File Editors in WP Admin
 * - Hides the submenu items
 * - Blocks direct access to editor screens
 */
function postali_disable_file_editors_menu() {
    // Remove Theme File Editor from Appearance menu
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    // Optional: also remove Plugin File Editor from Plugins menu
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}
add_action( 'admin_menu', 'postali_disable_file_editors_menu', 999 );

// Block direct access to the editors even if someone knows the URL
function postali_block_file_editors_direct_access() {
    wp_die( __( 'File editing through the WordPress admin is disabled.' ), 403 );
}
add_action( 'load-theme-editor.php', 'postali_block_file_editors_direct_access' );
add_action( 'load-plugin-editor.php', 'postali_block_file_editors_direct_access' );

/**
 * Disable the Additional CSS panel in the Customizer.
 * Primary method: remove the custom_css component early in load.
 */
function postali_disable_customizer_additional_css_component( $components ) {
    $key = array_search( 'custom_css', $components, true );
    if ( false !== $key ) {
        unset( $components[ $key ] );
    }
    return $components;
}
add_filter( 'customize_loaded_components', 'postali_disable_customizer_additional_css_component' );

/**
 * Fallback: remove the Additional CSS section if it's present.
 */
function postali_remove_customizer_additional_css_section( $wp_customize ) {
    if ( method_exists( $wp_customize, 'remove_section' ) ) {
        $wp_customize->remove_section( 'custom_css' );
    }
}
add_action( 'customize_register', 'postali_remove_customizer_additional_css_section', 20 );
