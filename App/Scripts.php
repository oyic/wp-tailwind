<?php
namespace Emma;

class Scripts
{
    public static $dist_js_path = '/dist/js/main.js' ;
    public static $dist_styles_path = '/dist/main.css';

    public static function load()
    {
        self::load_public_js();
        self::load_public_style();
    }

    public static function load_public_js()
    {
        if (!is_admin()):
            
            if (file_exists(get_template_directory().self::$dist_js_path)):
                $file = get_template_directory_uri() . self::$dist_js_path . "?" . filemtime(get_stylesheet_directory() . self::$dist_js_path);
                wp_register_script('app',$file, null, THEME_VERSION, true);
                wp_enqueue_script('app');
        endif;
        wp_localize_script(
                'app',
                'wpAjax', // Visible in app.js
                array( 'ajaxUrl' => admin_url('admin-ajax.php') )
            );
        endif;
    }

    public static function load_public_style()
    {
        if (!is_admin()) :

            wp_register_style('font-stylesheet', "https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap", array(), '', 'all');
            wp_enqueue_style('font-stylesheet');

            // default style.css
            wp_enqueue_style("wp-styles", get_stylesheet_uri());

            if (file_exists(get_template_directory() . self::$dist_styles_path)) :
                $file = get_template_directory_uri() . self::$dist_styles_path . "?" . filemtime(get_stylesheet_directory() . self::$dist_styles_path);

                wp_enqueue_style('app-style', $file, null, THEME_VERSION, 'all');
            endif;
        endif;
    }
}
