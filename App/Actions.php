<?php
namespace Emma;

use Emma\Menu;
use Emma\Images;
use Emma\AcfInit;
use Emma\Sidebars;

class Actions
{
    public static $actions = [ 
                              ['hook'=>'admin_init','method'=> [ AcfInit::class , 'acf_load_fields'] ],
                              ['hook'=>'init','method'=>[__CLASS__,'custom_cleanup_head'] ],
                              ['hook'=>'wp_before_admin_bar_render','method'=>[ Menu::class,'multisite_hide_menus'] ],
                              ['hook'=>'admin_menu','method'=>[Menu::class,'hide_menus']],
                              ['hook' => 'after_setup_theme','method'=>[ __CLASS__,'custom_theme_support'] ],
                              ['hook'=>'after_setup_theme','method'=>[Images::class,'set_images']],
                              ['hook'=>'widgets_init','method'=>[Sidebars::class,'load']]
                             ];
                           
   
    public static $filters = [
                              'the_generator'=>[ 'method'=>[__CLASS__,'custom_remove_rss_version'] ],
                              'wp_head'=>['method'=>[__CLASS__,'custom_remove_wp_widget_recent_comments_style'],'priority'=>1]
                             ];

   
    public static function load()
    {
        
        add_action('admin_init', [ AcfInit::class , 'acf_load_fields']);
        add_action( 'init',  [__CLASS__,'custom_cleanup_head']);
        add_action( 'wp_before_admin_bar_render',  [ Menu::class,'multisite_hide_menus']);
        add_action( 'admin_menu',  [Menu::class,'hide_menus']);
        add_action( 'after_setup_theme',  [ __CLASS__,'custom_theme_support']);
        add_action( 'widgets_init',  [Sidebars::class,'load']);
        // add_action( 'after_setup_theme',  [Images::class,'set_images']);
        
        add_filter( 'the_generator', [__CLASS__,'custom_remove_rss_version']);
        add_filter( 'wp_head', [__CLASS__,'custom_remove_wp_widget_recent_comments_style']);
        
        add_filter('deprecated_constructor_trigger_error', '__return_false');

        add_filter('use_block_editor_for_post', '__return_false', 10);

        /* Run permalinks save */
        add_action( 'init', [__CLASS__,'resave_permalinks'] );

        // foreach (self::$actions as $action) {
        //     add_action($action['hook'], $action['method'], isset($action['priority'])?$action['priority']:10, isset($action['params'])?$action['params']:null);
    

        // }

        // foreach (self::$filters as $hook=>$filter) {
        //     add_filter($hook, $filter['method'], isset($filter['priority'])?$filter['priority']:10, isset($filter['params'])?$filter['params']:null);
        // }
    }
    
    
    public static function custom_remove_wp_widget_recent_comments_style()
    {
        if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
            remove_filter('wp_head', 'wp_widget_recent_comments_style');
        }
    }


    public static function custom_remove_rss_version()
    {
        return '';
    }

    public static function custom_remove_recent_comments_style()
    {
        global $wp_widget_factory;
        if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
            remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
        }
    }

    public static function custom_cleanup_head()
    {
        // EditURI link.
        remove_action('wp_head', 'rsd_link');

        // Category feed links.
        remove_action('wp_head', 'feed_links_extra', 3);

        // Post and comment feed links.
        remove_action('wp_head', 'feed_links', 2);

        // Windows Live Writer.
        remove_action('wp_head', 'wlwmanifest_link');

        // Index link.
        remove_action('wp_head', 'index_rel_link');

        // Previous link.
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);

        // Start link.
        remove_action('wp_head', 'start_post_rel_link', 10, 0);

        // Canonical.
        remove_action('wp_head', 'rel_canonical', 10, 0);

        // Shortlink.
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

        // Links for adjacent posts.
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

        // WP version.
        remove_action('wp_head', 'wp_generator');

        // Emoji detection script.
        remove_action('wp_head', 'print_emoji_detection_script', 7);

        // Emoji styles.
        remove_action('wp_print_styles', 'print_emoji_styles');
    }


    public static function custom_theme_support()
    {
        // Switch default core markup for search form, comment form,
        // and comments to output valid HTML5
        add_theme_support('html5', [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]);

        // Add menu support
        add_theme_support('menus');

        // Let WordPress manage the document title
        add_theme_support('title-tag');

        // Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails
        add_theme_support('post-thumbnails');
       
        // RSS thingy
        add_theme_support('automatic-feed-links');

        // WooCommerce
        add_theme_support('woocommerce', [
                'thumbnail_image_width' => 240,
                'single_image_width' => 480,
            ]);
    }
    public static function resave_permalinks() 
    {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure( '/%postname%/' );
        flush_rewrite_rules(true);
    }
}
