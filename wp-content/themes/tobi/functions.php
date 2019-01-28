<?php
/**
 * Tobi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tobi
 */

define('TEMPLATE_DIRECTORY_URI', get_template_directory_uri());

if ( ! function_exists( 'tobi_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tobi_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Tobi, use a find and replace
		 * to change 'tobi' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tobi', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'tobi' ),
			'catalog' => esc_html__( 'Каталог', 'tobi' ),
			'footer' => esc_html__( 'Нижнее меню', 'tobi' )
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tobi_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );


		add_filter( 'get_the_archive_title', function( $title ){
			return preg_replace('~^[^:]+: ~', '', $title );
		});
	}
endif;
add_action( 'after_setup_theme', 'tobi_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tobi_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'tobi_content_width', 640 );
}
add_action( 'after_setup_theme', 'tobi_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tobi_widgets_init() {
	register_sidebar( array(
		'id' => 'product_filter',
		'name' => __('Фильтры товаров'),
		'before_widget' => '<li id="%1$s" style="display: list-item;" class="widget %2$s">',
		'after_widget'  => "</li>\n",
		'before_title' 	=> '<p>',
		'after_title' 	=> '</p>',
	));
}
add_action( 'widgets_init', 'tobi_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tobi_scripts() {
	wp_enqueue_style( 'tobi-style', get_stylesheet_uri() );
	wp_enqueue_style( 'tobi-fonts', TEMPLATE_DIRECTORY_URI . '/css/fonts.css' );
	wp_enqueue_style( 'tobi-reset', TEMPLATE_DIRECTORY_URI . '/css/reset.css' );
	wp_enqueue_style( 'tobi-main', TEMPLATE_DIRECTORY_URI . '/css/main.css' );
	wp_enqueue_style( 'tobi-media', TEMPLATE_DIRECTORY_URI . '/css/media.css' );

	wp_enqueue_style( 'slick', TEMPLATE_DIRECTORY_URI . '/libs/slick/slick.css' );
	wp_enqueue_style( 'slick-theme', TEMPLATE_DIRECTORY_URI . '/libs/slick/slick-theme.css', array('slick') );

	wp_enqueue_script( 'tobi-navigation', TEMPLATE_DIRECTORY_URI . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'tobi-common', TEMPLATE_DIRECTORY_URI . '/js/common.js', array(), '', true);

    wp_enqueue_script( 'tobi-woocommerce', TEMPLATE_DIRECTORY_URI . '/js/woocommerce.js', array('tobi-common'), '', true);	

	wp_enqueue_script( 'tobi-slick', TEMPLATE_DIRECTORY_URI . '/libs/slick/slick.min.js', array('tobi-common'));

	wp_enqueue_script( 'tobi-skip-link-focus-fix', TEMPLATE_DIRECTORY_URI . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if( is_checkout() ){
		wp_enqueue_script( 'wc-cart' );
	}
}
add_action( 'wp_enqueue_scripts', 'tobi_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


remove_filter( 'woocommerce_add_to_cart_redirect', 'rg108_checkout_woo_redirect' );


function tobi_pre_get_posts($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search) {
            $query->set('post_type', 'product');
        }
    }
}
add_action('pre_get_posts', 'tobi_pre_get_posts');

/**
 * Auto update cart after quantity change
 *
 * @return  string
 **/
add_action( 'wp_footer', 'cart_update_qty_script' );
function cart_update_qty_script() {
    if (is_cart()) :
    ?>
    <script>
        jQuery('div.woocommerce').on('change', '.qty', function(){
            jQuery("[name='update_cart']").trigger("click"); 
        });
    </script>
    <?php
    endif;
}