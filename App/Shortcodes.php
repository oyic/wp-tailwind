<?php
// namespace Emma;

// class Shortcodes{
//     public function __construct()
//     {
//         add_shortcode( 'search-me', [$this,'search_me'] );
//         add_shortcode('show_accordion',[$this,'show_accordion']);
//         add_shortcode( 'get_template_part', [$this,'get_template_part'] );

//     }
//     public function search_me()
//     {
//         ob_start();
//         echo get_search_form();
//         return ob_get_clean();    
//     }
//     public function show_accordion()
//     {
//         ob_start();
//         get_template_part('parts/accordion');   
//         return ob_get_clean();
//     }
//     public function get_template_part( $atts ) {
//         $a = shortcode_atts( array(
//             'part' => null
//         ), $atts );
//         ob_start();
//         get_template_part('parts/'.$a['part']);
//         return ob_get_clean();
//     }

// }