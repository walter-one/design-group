<?php


if ( ! function_exists( 'tt_themeton_theme_setup' ) ) :
    function tt_themeton_theme_setup() {

        // load translate file
        load_theme_textdomain( 'themeton', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 640, 380, true );

        // Set Image sizes
        add_image_size( 'post-thumb', 720, 0, true );

        // Set Image sizes
        add_image_size( 'folio-grid', 640, 427, true );
        add_image_size( 'folio-item', 640, 0, true );
        
        add_image_size( 'woo-thumb', 400, 0, true );


        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'acerola' )
        ) );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

    }
endif;
add_action( 'after_setup_theme', 'tt_themeton_theme_setup' );


// default content width
if ( ! isset( $content_width ) ) $content_width = 940;



$tt_sidebars = array();
$tt_sidebars = array_merge(array(
    'sidebar'=> esc_html__('Post Sidebar Area', 'acerola'),
    'sidebar-page'=> esc_html__('Page Sidebar Area', 'acerola'),
    'sidebar-portfolio'=> esc_html__('Portfolio Sidebar Area', 'acerola'),
    'sidebar-woo'=> esc_html__('Woocommerce Sidebar Area', 'acerola')
), $tt_sidebars);

// Register widget area.
function tt_theme_widgets_init() {
    
    global $tt_sidebars;
    if(isset($tt_sidebars)) {
        foreach ($tt_sidebars as $id => $sidebar) {
            if( !empty($id) ){
                if( $id=='sidebar-portfolio' && !class_exists('TT_Portfolio_PT') )
                    continue;
                
                register_sidebar(array(
                    'name' => $sidebar,
                    'id' => $id,
                    'description' => esc_html__( 'Add widgets here to appear in your sidebar.', 'acerola' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h4 class="widget_title">',
                    'after_title'   => '</h4>'
                ));                
            }
        }
    }


    // Footer widget areas
    $footer_widget_num = TT::get_mod('footer_widget_num');

    for($i=1; $i<=$footer_widget_num ; $i++ ) {
        register_sidebar(
            array(
                'name'          => esc_html__( 'Footer Column', 'acerola' ) . ' ' .$i,
                'id'            => 'footer'.$i,
                'description'   => esc_html__( 'Add widgets here to appear in your footer column', 'acerola' ) . ' ' .$i,
                'before_widget' => '<div id="%1$s" class="footer_widget widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="title">',
                'after_title'   => '</h4>',
            )
        );
    }

    // Sub Footer Bar Content
   
}

add_action( 'widgets_init', 'tt_theme_widgets_init' );



if ( ! function_exists( 'tt_theme_fonts_url' ) ) :
    function tt_theme_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        $fonts[] = 'Roboto+Slab:400,100,300,700';

        if ( $fonts ) {
            $fonts_url = esc_url(add_query_arg( array(
                'family' => implode( '|', $fonts ),
                'subset' => urlencode( $subsets ),
            ), '//fonts.googleapis.com/css' ));
        }

        return $fonts_url;
    }
endif;





function tt_theme_enqueue_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'wp-mediaelement' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'theme-fonts', tt_theme_fonts_url(), array(), null );


    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
    wp_enqueue_style( 'animsition', get_template_directory_uri() . '/css/animsition.min.css' );
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );
    wp_enqueue_style( 'icon-fonts', get_template_directory_uri() . '/css/font.css' );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/slider.css' );
    

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', false, false, true );
    wp_enqueue_script( 'bootstrap-slider', get_template_directory_uri() . '/js/bootstrap-slider.js', false, false, true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', false, false, true );
    wp_enqueue_script( 'animsition', get_template_directory_uri() . '/js/jquery.animsition.min.js', false, false, true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', false, false, true );
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/idangerous.swiper.min.js', false, false, true );
    wp_enqueue_script( 'count-to', get_template_directory_uri() . '/js/jquery.countTo.js', false, false, true );
    wp_enqueue_script( 'sliphover', get_template_directory_uri() . '/js/jquery.sliphover.min.js', false, false, true );
    wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', false, false, true );
    wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', false, false, true );


    wp_enqueue_style( 'theme-stylesheet', get_stylesheet_uri() );
    wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/js/all.js', false, false, true );

    
}
add_action( 'wp_enqueue_scripts', 'tt_theme_enqueue_scripts' );




add_filter( 'body_class', 'tt_body_class_filter' );
function tt_body_class_filter( $classes ) {

    global $post;
    $po = $post;
    $page_for_posts = get_option('page_for_posts');
    $is_blog_page = is_home() && get_post_type($post) && !empty($page_for_posts) ? true : false;
    if( (is_page() || $is_blog_page) && $is_blog_page ){
        $po = get_post($page_for_posts);
    }

    if( isset($po->ID) && TT::getmeta('header_only_logo', $po->ID)=='1' ){
        $classes[] = 'scroll-head';
    }

    if( is_user_logged_in() ){
        $classes[] = 'start-transition';
    }

    return $classes;
}




function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function custom_excerpt_more( $excerpt ) {
    return ' ...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );


function tt_mime_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter('upload_mimes', 'tt_mime_types', 1, 1);









if( ! function_exists('tt_print_main_menu') ) :
    function tt_print_main_menu($menu_class = ''){
        global $post;
        $po = $post;
        $page_for_posts = get_option('page_for_posts');
        $is_blog_page = is_home() && get_post_type($post) && !empty($page_for_posts) ? true : false;
        if( (is_page() || $is_blog_page) && $is_blog_page )
            $po = get_post($page_for_posts);

        if( isset($po->ID) && TT::getmeta('one_page_menu', $po->ID)=='1' ){
            $content = $po->post_content;
            $pattern = get_shortcode_regex();

            echo "<ul class='$menu_class one-page-menu'>";
            if( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'vc_row', $matches[2] ) ){
                foreach ($matches[3] as $attr) {
                    $props = array();
                    $sarray = explode('" ', trim($attr));
                    foreach ($sarray as $val) {
                        $el =explode("=", $val);
                        $s1 = str_replace('"', '', trim($el[0]));
                        if( isset($el[1]) ){
                            $s2 = str_replace('"', '', trim($el[1]));
                            $props[$s1] = $s2;
                        }
                    }

                    if( isset($props['one_page_section'], $props['one_page_label']) && $props['one_page_section']=='yes' && !empty($props['one_page_label']) ){
                        $label = $props['one_page_label'];
                        $slug = isset($props['one_page_slug']) && !empty($props['one_page_slug']) ? $props['one_page_slug'] : TT::create_slug($props['one_page_label']);

                        echo "<li class='menu-item'><a class='scroll-to-link' href='#".esc_attr($slug)."'>$label</a></li>";
                    }

                }
            }
            echo "</ul>";
        }
        else{
            wp_nav_menu( array(
                'menu_id'           => 'primary-nav',
                'menu_class'        => $menu_class,
                'theme_location'    => 'primary',
                'container'         => '',
                'fallback_cb'       => 'tt_primary_callback'
            ) );
        }
    }
endif;






function tt_primary_callback(){
    echo '<ul>';
    wp_list_pages( array(
        'sort_column'  => 'menu_order, post_title',
        'title_li' => '') );
    echo '</ul>';
}




/*
                                                                    
 _____ _                 _              _____ _                     
|_   _| |_ ___ _____ ___| |_ ___ ___   |     | |___ ___ ___ ___ ___ 
  | | |   | -_|     | -_|  _| . |   |  |   --| | .'|_ -|_ -| -_|_ -|
  |_| |_|_|___|_|_|_|___|_| |___|_|_|  |_____|_|__,|___|___|___|___|
  
*/
  // Themeton Standard Package
require_once get_template_directory() . '/framework/classes/class.themeton.std.php';

// Include current theme customize
require_once TT::file_require(get_template_directory() . '/includes/functions.php');





// Print Favicon
add_action('wp_head', 'tt_print_favicon');
function tt_print_favicon(){
    if(TT::get_mod('favicon') != '')
        echo '<link rel="shortcut icon" type="image/x-icon" href="'.TT::get_mod('favicon').'"/>';
}

// Prints Custom Logo Image for Login Page
add_action('login_head', 'custom_login_logo');
function custom_login_logo() {
    $logo = TT::get_mod('logo_admin');
    if (!empty($logo)) {
        $logo = str_replace('[site_url]', site_url(), $logo);
        echo '<style type="text/css">.login h1 a { background: url(' . $logo . ') center center no-repeat !important;width: auto !important;}</style>';
    }
}



?>