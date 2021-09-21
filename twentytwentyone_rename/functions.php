<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twenty_twenty_one_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Twenty-One, use a find and replace
		 * to change 'twentytwentyone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentytwentyone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
				'footer'  => __( 'Secondary menu', 'twentytwentyone' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		if ( 127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'twentytwentyone' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'twentytwentyone' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'twentytwentyone' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'twentytwentyone' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'twentytwentyone' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'twentytwentyone' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'twentytwentyone' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Black', 'twentytwentyone' ),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__( 'Dark gray', 'twentytwentyone' ),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__( 'Gray', 'twentytwentyone' ),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__( 'Green', 'twentytwentyone' ),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__( 'Blue', 'twentytwentyone' ),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__( 'Purple', 'twentytwentyone' ),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__( 'Red', 'twentytwentyone' ),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__( 'Orange', 'twentytwentyone' ),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__( 'Yellow', 'twentytwentyone' ),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__( 'White', 'twentytwentyone' ),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__( 'Purple to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__( 'Green to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to green', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__( 'Red to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__( 'Purple to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__( 'Red to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', twenty_twenty_one_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );
	}
}
add_action( 'after_setup_theme', 'twenty_twenty_one_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twenty_twenty_one_content_width', 750 );
}
add_action( 'after_setup_theme', 'twenty_twenty_one_content_width', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_scripts' );

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script() {

	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwentyone_block_editor_script' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	}

	// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
	$custom_css = twenty_twenty_one_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twenty-twenty-one-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'twentytwentyone_customize_preview_init' );

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts' );

/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
	$classes = apply_filters( 'twentytwentyone_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_ie_class' );

$sub_menu_counter = -1;
// свой класс построения меню:
class My_Walker_Nav_Menu extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth ) {
		$sub_menu_counter++;
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'dropdown-menu',
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
			);
		$class_names = implode( ' ', $classes );
		$attribs = 'aria-labelledby="navbarDropdown-'.$sub_menu_counter.'"';

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '" '.$attribs.'">' . "\n";		
	}

	// add main/sub classes to li's and links
	function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		array_push($classes, "nav-item");	 
		if (in_array("menu-item-has-children", $classes)) array_push($classes, "dropdown");

		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );


		// build html
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ( in_array("menu-item-has-children", $classes)&&( $depth == 0 ) ? 'id="navbarDropdown-'. $sub_menu_counter . '"' : '' ).'class="nav-link menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) .( in_array("menu-item-has-children", $classes)&&( $depth == 0 ) ? ' dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" ' : ''  ).'"';

		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

function my_nav_menu( $args ) {

	$args = array_merge( [
		'container'       => '',
		'container_id'    => '',
		'container_class' => '',
		'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0',
		'echo'            => false,
		'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
		'depth'           => 10,
		'walker'          => new My_Walker_Nav_Menu()
	], $args );

	echo wp_nav_menu( $args );
}

if(!is_user_logged_in()) {
	remove_action('wp_head','wp_generator');
	remove_action('wp_head','wlwmanifest_link');
	remove_action('wp_head','wp_resource_hints', 2);
	remove_action('wp_head','wlwmanifest_link');
	remove_action('wp_head','rsd_link');
	remove_action('wp_head','rel_canonical');
	remove_action('wp_head','wp_site_icon');
	remove_action('wp_head','wp_oembed_add_discovery_links' );
	remove_action('wp_head','wp_oembed_add_host_js' );
	remove_action('wp_head','feed_links_extra', 3 );
	remove_action('wp_head','feed_links', 2 );

	add_action( 'wp_enqueue_scripts', 'del_style' );
	function del_style(){
	  wp_dequeue_style('bodhi-svgs-attachment');
	}
	wp_dequeue_style('wp-block-library');
	function dashicons_admin_only() {
	    if(!is_user_logged_in()) {
	        global $wp_styles;
	        wp_dequeue_style('dashicons');
	        // wp_deregister_style('dashicons') causes internal PHP errors in WordPress !
	        $wp_styles->registered['dashicons']->src = '';
	        wp_dequeue_style('wp-block-library');
	        // wp_deregister_style('dashicons') causes internal PHP errors in WordPress !
	        $wp_styles->registered['wp-block-library']->src = '';
	    }
	}
	wp_dequeue_style('wp-block-library-theme-inline');
	global $wp_styles;
	wp_dequeue_style('wp-block-library');
	// wp_deregister_style('dashicons') causes internal PHP errors in WordPress !
	$wp_styles->registered['wp-block-library']->src = '';
	wp_dequeue_style('twenty-twenty-one-style');
	wp_dequeue_style('twenty-twenty-one-style-inline');
	wp_dequeue_style('twenty-twenty-one-print-style');
	add_action( 'wp_enqueue_scripts', 'jquery_script_method' );
	function jquery_script_method() {
	  wp_deregister_script( 'jquery' );
	  wp_enqueue_script( 'jquery' );
	}
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	function g4_add_defer_attribute( $tag, $handle ) {

	    if ( 'jquery.js' === $handle ) {
	        return $tag;
	    }
	 
	   return str_replace( ' src', ' defer src', $tag );
	}
	add_filter( 'script_loader_tag', 'g4_add_defer_attribute', 10, 2 );
}

function custom_scripts() {	
	wp_enqueue_style( 'bootstrap.min.css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array());
    wp_enqueue_style( 'header.css', get_template_directory_uri() . '/g4_templates/css/header.css', array());
    wp_enqueue_style( 'owl-carousel.css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array());
    wp_enqueue_style( 'owl-carousel-theme.css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array());
    wp_enqueue_style( 'animate.css', get_template_directory_uri() . '/g4_templates/css/animate.css', array());
    if( is_front_page() ) wp_enqueue_style( 'frontpage.css', get_template_directory_uri() . '/g4_templates/css/frontpage.css', array());
    if( (get_page_template_slug( get_the_ID() ) == 'g4_templates/catalog_page_tpl.php')||( get_queried_object()->post_title != 'Новости' )|| (get_page_template_slug( get_the_ID() ) == 'g4_templates/catalog_news_tpl.php')|| (get_page_template_slug( get_the_ID() ) == 'g4_templates/inner_page_tpl.php')) wp_enqueue_style( 'catalog_page.css', get_template_directory_uri() . '/g4_templates/css/catalog_page.css', array());
    	
    	$url_zapros = urldecode($_SERVER['REQUEST_URI']); 	
	 	$mystring = $url_zapros;
		$findme   = 'wp-admin';
		$pos = strpos($mystring, $findme);

		if ($pos === false) {
	    	$categories = get_terms('katalog');
			foreach( $categories as $categorie ){ 
				$equal = true;
				$to_check1 = preg_split("//u", $url_zapros , -1, PREG_SPLIT_NO_EMPTY);
				$to_check2 = preg_split("//u",  '/'.urldecode($categorie->slug).'/' , -1, PREG_SPLIT_NO_EMPTY);				
				if( count( $to_check1 ) == count( $to_check2 ) ){
					for( $i = 0; $i < count( $to_check1 );$i++ ){
						if( $to_check1[$i] != $to_check2[$i] ){
							$equal = false;
							break;
						}
					}
				}		
				else $equal = false;
				if( $equal ){
					wp_enqueue_style( 'catalog_page.css', get_template_directory_uri() . '/g4_templates/css/catalog_page.css', array());
				}
			}
		}

    wp_enqueue_style( 'footer.css', get_template_directory_uri() . '/g4_templates/css/footer.css', array());


    wp_enqueue_script( 'jquery.js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' );
    wp_enqueue_script( 'youtube_api.js', 'https://www.youtube.com/iframe_api', array('jquery.js'), null, false );
    wp_enqueue_script( 'ymaps_api.js', 'https://api-maps.yandex.ru/2.1/?apikeyapikey=b6f4126d-3274-40c4-a690-da208ca8a31e&lang=ru_RU', array('jquery.js'), null, false );
    wp_enqueue_script( 'bootstrap.popper.js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery.js'), null, true );
    wp_enqueue_script( 'owl-carusel.js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery.js'), null, false );
    wp_enqueue_script( 'cookie.js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js', array('jquery.js'), null, false );
    wp_enqueue_script( 'animate.min.js', get_template_directory_uri() . '/g4_templates/js/animate.min.js', array('jquery.js'), null, true );
	wp_enqueue_script( 'bootstrap.min.js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('bootstrap.popper.js'), null, true );
	//wp_enqueue_script( 'bootstrap.bundle.min.js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js', array('bootstrap.min.js'), null, true );

}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );

function true_breadcrumbs(){
 	$url_zapros = urldecode($_SERVER['REQUEST_URI']);
 	
 	$mystring = $url_zapros;
	$findme   = 'wp-admin';
	$pos = strpos($mystring, $findme);

	if ($pos === false) {
		// получаем номер текущей страницы
		$page_num = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	 
		$separator = ' / '; //  разделяем обычным слэшем, но можете чем угодно другим
	 
		// если главная страница сайта
		if( is_front_page() ){
	 
			if( $page_num > 1 ) {
				echo '<a href="' . site_url() . '">Главная</a>' . $separator . $page_num . '-я страница';
			} else {
				echo 'Вы находитесь на главной странице';
			}
	 
		} else { // не главная
	 		
	 		$language = 'rus';
        	if (isset($_COOKIE["language"])) $language = $_COOKIE["language"];

        	$main_page = ( $language == 'eng' ) ? 'Main page' : 'Главная';
			echo '<a href="' . site_url() . '">'.$main_page.'</a>' . $separator;
	 
	 
			if( is_single() ){ // записи
				$url_zapros = urldecode($_SERVER['REQUEST_URI']);
				$categories = get_terms('katalog'); $page_found = false;
				foreach( $categories as $categorie ){
					/* для товаров */ 
					$myterms = get_posts( array(
						'numberposts' => -1,
						'orderby'     => 'date',
						'order'       => 'ASC',
						'post_type'   => 'catalog',
						'suppress_filters' => true,
						'tax_query' => array(
				            array(
				                'taxonomy' => 'katalog',
				                'field'    => 'slug',
				                'terms'    => $categorie->slug,
				            )
				        )
					) );
					foreach( $myterms as $term ){ 
						$equal = true;
						$to_check1 = preg_split("//u", $url_zapros , -1, PREG_SPLIT_NO_EMPTY);
						$to_check2 = preg_split("//u",  '/'.urldecode($categorie->slug).'/'.urldecode($term->post_name).'/' , -1, PREG_SPLIT_NO_EMPTY);	
						if( count( $to_check1 ) == count( $to_check2 ) ){
							for( $i = 0; $i < count( $to_check1 );$i++ ){
								if( $to_check1[$i] != $to_check2[$i] ){
									$equal = false;
									break;
								}
							}
						}		
						else $equal = false;
						if( $equal ){
							$page_found = true;
							$categorie_page = ( $language == 'eng' ) ? $categorie->slug.'/' . '">' .get_field('название_на_английском',$categorie) : $categorie->slug.'/' . '">' .$categorie->name;
							echo '<a href="' . '/'.$categorie_page.'</a>'; echo $separator;
							$page_name = ( $language == 'eng' ) ? get_field('название_на_английском',$term) : urldecode($term->post_title);
							echo $page_name;
							break;
						}
					}		
				}
				if( $page_found == false ){ 
					$check_empty_category = get_category( ', ' ); 
					if( $check_empty_category != '' ){
						the_category( ', ' ); echo $separator;
					}
					the_title();
				}
	 
			} elseif ( is_page() ){ // страницы WordPress 


				$url_zapros = urldecode($_SERVER['REQUEST_URI']);
	 	
			 	$mystring = $url_zapros;
				$findme   = 'wp-admin';
				$pos = strpos($mystring, $findme);

				global $post;
				// если у текущей страницы существует родительская
				if ( $post->post_parent ) {
				 
					$parent_id  = $post->post_parent; // присвоим в переменную
					$breadcrumbs = array(); 
				 
					while ( $parent_id ) {
						$page = get_page( $parent_id );
						$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
						$parent_id = $page->post_parent;
					}
				 
					echo join( $separator, array_reverse( $breadcrumbs ) ) . $separator;
				 
				}
				else{
					if ($pos === false) {
						$categorie_page = ( $language == 'eng' ) ? get_field('первая_секция',$post->ID)['название_на_английском'] : the_title();
						echo $categorie_page;
					}
				}				
	 			
	 
			} elseif ( is_category() ) {
				single_cat_title();
	 
			} elseif( is_tag() ) {
				single_tag_title();
	 
			} elseif ( is_day() ) { // архивы (по дням)
	 
				echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
				echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a>' . $separator;
				echo get_the_time('d');
	 
			} elseif ( is_month() ) { // архивы (по месяцам)
	 
				echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
				echo get_the_time('F');
	 
			} elseif ( is_year() ) { // архивы (по годам)
	 
				echo get_the_time( 'Y' );
	 
			} elseif ( is_author() ) { // архивы по авторам
	 
				global $author;
				$userdata = get_userdata( $author );
				echo 'Опубликовал(а) ' . $userdata->display_name;
	 
			} elseif ( is_404() ) { // если страницы не существует
	 
				echo 'Ошибка 404';
	 
			}
			else{
				$url_zapros = urldecode($_SERVER['REQUEST_URI']);
	 	
			 	$mystring = $url_zapros;
				$findme   = 'wp-admin';
				$pos = strpos($mystring, $findme);

				function custom_strcmp($string1,$string2){
					$equal = true;
					$to_check1 = preg_split("//u", $string1 , -1, PREG_SPLIT_NO_EMPTY);
					$to_check2 = preg_split("//u", $string2 , -1, PREG_SPLIT_NO_EMPTY);				
					if( count( $to_check1 ) == count( $to_check2 ) ){
						for( $i = 0; $i < count( $to_check1 );$i++ ){
							// echo count( $to_check1 ).' '.count( $to_check2 ).' | '.print_r($to_check1); echo ' | '; print_r( $to_check2 ); echo '<br /><br />';
							if( $to_check1[$i] != $to_check2[$i] ){
								$equal = false;
								break;
							}
						}
					}		
					else $equal = false;		

					return $equal;
				}

				if ($pos === false) {
					$categories = get_terms('katalog');
					foreach( $categories as $categorie ){ 
						/* для рубрик */
						if( custom_strcmp( $url_zapros, '/'.urldecode($categorie->slug).'/') ){
							$categorie_page = ( $language == 'eng' ) ? get_field('название_на_английском',$categorie) : $categorie->name;
							echo $categorie_page;
							break;
						}
					}	

					$news_list = get_terms('news');
					foreach( $news_list as $news ){ 
						/* для рубрик */
						if( custom_strcmp( $url_zapros, '/'.urldecode($news->slug).'/') ){
							$categorie_page = ( $language == 'eng' ) ? get_field('название_на_английском',$news) : $news->name;
							echo $categorie_page;
							break;
						}
					}	    
				}
			}
	 
			if ( $page_num > 1 ) { // номер текущей страницы
				echo ' (' . $page_num . '-я страница)';
			}
	 
		}
	}
 
}

function true_301_redirect() {
	/* в массиве указываем все старые=>новые ссылки  */
	$rules = array(
		array('old'=>'/без-категории/политика-конфиденциальности/','new'=>'/политика-конфиденциальности/'), // рубрика
	);
	foreach( $rules as $rule ) :
		// если URL совпадает с одним из указанных в массиве, то редиректим
		if( urldecode($_SERVER['REQUEST_URI']) == $rule['old'] ) :
			wp_redirect( site_url( $rule['new'] ), 301 );
			exit();
		endif;
	endforeach;
}
 
add_action('template_redirect', 'true_301_redirect');

function true_request( $query ){
	$url_zapros = urldecode($_SERVER['REQUEST_URI']);
 	
 	$mystring = $url_zapros;
	$findme   = 'wp-admin';
	$pos = strpos($mystring, $findme);
	if ($pos === false) {
		$categories = get_terms('katalog'); $page_found = false;
		foreach( $categories as $categorie ){ 
			$equal = true;
			$to_check1 = preg_split("//u", $url_zapros , -1, PREG_SPLIT_NO_EMPTY);
			$to_check2 = preg_split("//u",  '/'.urldecode($categorie->slug).'/' , -1, PREG_SPLIT_NO_EMPTY);				
			if( count( $to_check1 ) == count( $to_check2 ) ){
				for( $i = 0; $i < count( $to_check1 );$i++ ){
					if( $to_check1[$i] != $to_check2[$i] ){
						$equal = false;
						break;
					}
				}
			}		
			else $equal = false;
			if( $equal ){
				$query['katalog'] = $categorie->slug;
				unset($query['category_name']);
				$page_found = true;
				break;
			}
		}
		if( $page_found == false ){
			foreach( $categories as $categorie ){ 
				$myterms = get_posts( array(
					'numberposts' => -1,
					'orderby'     => 'date',
					'order'       => 'ASC',
					'post_type'   => 'catalog',
					'suppress_filters' => true,
					'tax_query' => array(
			            array(
			                'taxonomy' => 'katalog',
			                'field'    => 'slug',
			                'terms'    => $categorie->slug,
			            )
			        )
				) );
				foreach( $myterms as $term ){ 
					$equal = true;
					$to_check1 = preg_split("//u", $url_zapros , -1, PREG_SPLIT_NO_EMPTY);
					$to_check2 = preg_split("//u",  '/'.urldecode($categorie->slug).'/'.urldecode($term->post_name).'/' , -1, PREG_SPLIT_NO_EMPTY);	
					if( count( $to_check1 ) == count( $to_check2 ) ){
						for( $i = 0; $i < count( $to_check1 );$i++ ){
							if( $to_check1[$i] != $to_check2[$i] ){
								$equal = false;
								break;
							}
						}
					}		
					else $equal = false;
					if( $equal ){
						$query['post_type'] = 'catalog';
						$query['catalog'] = $query['name'];
						unset($query['category_name']);
						$page_found = true;
						break;
					}
				}		
			}
		}
		/*if( $page_found == false ){
			foreach( $categories as $categorie ){ 
				$myterms = get_posts( array(
					'numberposts' => -1,
					'orderby'     => 'date',
					'order'       => 'ASC',
					'post_type'   => 'news',
					'suppress_filters' => true,
				) );
				foreach( $myterms as $term ){ 
					$equal = true;
					$to_check1 = preg_split("//u", $url_zapros , -1, PREG_SPLIT_NO_EMPTY);
					$to_check2 = preg_split("//u",  '/'.urldecode($categorie->slug).'/'.urldecode($term->post_name).'/' , -1, PREG_SPLIT_NO_EMPTY);	
					if( count( $to_check1 ) == count( $to_check2 ) ){
						for( $i = 0; $i < count( $to_check1 );$i++ ){
							if( $to_check1[$i] != $to_check2[$i] ){
								$equal = false;
								break;
							}
						}
					}		
					else $equal = false;
					if( $equal ){
						$query['post_type'] = 'news';
						$query['catalog'] = $query['name'];
						unset($query['category_name']);
						$page_found = true;
						break;
					}
				}		
			}
		}*/
		if( $page_found == false ){
			if( $url_zapros == '/политика-конфиденциальности/' ){
				$query['name'] = '%d0%bf%d0%be%d0%bb%d0%b8%d1%82%d0%b8%d0%ba%d0%b0-%d0%ba%d0%be%d0%bd%d1%84%d0%b8%d0%b4%d0%b5%d0%bd%d1%86%d0%b8%d0%b0%d0%bb%d1%8c%d0%bd%d0%be%d1%81%d1%82%d0%b8';
				$query['category_name'] = '%d0%b1%d0%b5%d0%b7-%d0%ba%d0%b0%d1%82%d0%b5%d0%b3%d0%be%d1%80%d0%b8%d0%b8';
				
			}			
		}

	}	
	return $query;
}
	 
add_filter( 'request', 'true_request', 9999, 1 );

function true_posts_links( $url, $post ){
	if( !is_object( $post ) )
		$post = get_post( $post_id );
 
	$replace = $post->post_name;
 
	/* замены для записей и страниц,
		к сожалению тут только по ID замену можно сделать */
 
	if( $post->ID == 332 ) 
		$replace = 'политика-конфиденциальности';
 
	$url = str_replace($post->post_name, $replace, $url );
	return $url;
}
 
add_filter( 'post_link', 'true_posts_links', 'edit_files', 2 );
add_filter( 'page_link', 'true_posts_links', 'edit_files', 2 );
add_filter( 'post_type_link', 'true_posts_links', 'edit_files', 2 );

add_filter( 'get_the_archive_title', 'webpro_remove_name_cat' );
function webpro_remove_name_cat( $title ){
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	}
	return $title;
}
function custom_posts_per_page($query){
    if(!is_admin() && $query->is_main_query() && is_post_type_archive()){ //количество записей в пользовательстком типе записей
    $query->set('posts_per_page',50);
    }
   if(!is_admin() && $query->is_main_query() && is_tax()){ //количество записей в пользовательстком типе записей в таксономиях
    $query->set('posts_per_page',50);
    }
}
add_action('pre_get_posts','custom_posts_per_page');
/*function true_request( $query ){
 
	$url_zapros = urldecode($_SERVER['REQUEST_URI']);
 	
 	$mystring = $url_zapros;
	$findme   = 'wp-admin';
	$pos = strpos($mystring, $findme);

	if ($pos === false) {
		if( $url_zapros == '/рисововая-продукция/' ){
			$query['katalog'] = '%D1%80%D0%B8%D1%81%D0%BE%D0%B2%D0%BE%D0%B2%D0%B0%D1%8F-%D0%BF%D1%80%D0%BE%D0%B4%D1%83%D0%BA%D1%86%D0%B8%D1%8F';
			unset($query['category_name']);
		}
		return $query;
	}	
}
	 
add_filter( 'request', 'true_request', 9999, 1 );*/

add_filter( 'get_the_excerpt', 'true_no_excerpt_for_post_5', 25, 2 );
 
function true_no_excerpt_for_post_5( $excerpt, $post ) {
    if (isset($_COOKIE["language"])){
    	if( $_COOKIE["language"] == 'eng') $excerpt = get_field('описание_на_английском',$post->ID);
    }
	return $excerpt;
 
}
function new_excerpt_more($more) {
       global $post;
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_filter( 'excerpt_length', function(){
	return 20;
} );