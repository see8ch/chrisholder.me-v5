<?php
/**
 * see8ch functions and definitions
 *
 * @package see8ch
 */


// Control Visible Admin Menus
function remove_menus(){
  remove_menu_page( 'index.php' );                      //  Dashboard
  remove_menu_page( 'edit.php' );                       //  Posts
  remove_menu_page( 'upload.php' );                    //  Media
  remove_menu_page( 'edit.php?post_type=page' );    //  Pages
  remove_menu_page( 'edit-comments.php' );           //  Comments
  remove_menu_page( 'themes.php' );                   //  Appearance
  remove_menu_page( 'plugins.php' );                   //  Plugins
  remove_menu_page( 'users.php' );                     //  Users
  remove_menu_page( 'tools.php' );                     //  Tools
  remove_menu_page( 'options-general.php' );         //  Settings
}
// add_action( 'admin_menu', 'remove_menus' );



// ACF Options Page
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
}

// jQuery
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://code.jquery.com/jquery-latest.min.js", false, null);
   wp_enqueue_script('jquery');
}


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'see8ch_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function see8ch_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on see8ch, use a find and replace
	 * to change 'see8ch' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'see8ch', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'see8ch' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'see8ch_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // see8ch_setup
add_action( 'after_setup_theme', 'see8ch_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function see8ch_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'see8ch' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'see8ch_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function see8ch_scripts() {
	wp_enqueue_style( 'see8ch-style', get_stylesheet_uri() );
	wp_enqueue_style( 'see8ch-lato', 'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' );
	// wp_enqueue_style( 'see8ch-merriweather', 'http://fonts.googleapis.com/css?family=Merriweather:400,700,900,300,300italic,400italic,900italic,700italic' );
	// wp_enqueue_style( 'see8ch-arvo', 'http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic' );
	wp_enqueue_style( 'see8ch-aleo', get_template_directory_uri() . '/assets/fonts/aleo/font.css' );
	// Genericons
	wp_enqueue_style( 'see8ch-genericons', get_template_directory_uri() . '/assets/fonts/genericons/genericons.css' );

	// Scripts
	wp_enqueue_script( 'see8ch-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'see8ch_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



// Custom Post Types
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'projects',
    array(
      'labels' => array(
        'name' => __( 'Projects' ),
        'singular_name' => __( 'Project' )
      ),
      'public' => true,
      'has_archive' => true,
      'taxonomies' => array('category'),
    )
  );
}
