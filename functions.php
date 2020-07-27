<?php

require_once __DIR__ . '/App/app.php';

$theme = new \Emma\Theme();


class F6_DRILL_MENU_WALKER extends Walker_Nav_Menu
{
    /*
	 * Add vertical menu class
	 */

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"vertical menu\">\n";
    }
}

function f6_drill_menu_fallback($args)
{
    /*
	 * Instantiate new Page Walker class instead of applying a filter to the
	 * "wp_page_menu" function in the event there are multiple active menus in theme.
	 */

    $walker_page = new Walker_Page();
    $fallback    = $walker_page->walk(get_pages(), 0);
    $fallback    = str_replace("children", "children vertical menu", $fallback);
    echo '<ul class="vertical medium-horizontal menu" data-alignment="right" data-responsive-menu="drilldown medium-dropdown" style="width: 100%;">' . $fallback . '</ul>';
}

if( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page();
}

// Default Product Category if ommitted

// function mfields_set_default_object_terms( $post_id, $post ) {
// 	if ( 'publish' === $post->post_status ) {
// 		$defaults = array(
// 			'poc' => array( 'email-form' ),
// 		);
// 		$taxonomies = get_object_taxonomies( $post->post_type );
// 		foreach ( (array) $taxonomies as $taxonomy ) {
// 			$terms = wp_get_post_terms( $post_id, $taxonomy );
// 			if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
// 				wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
// 			}
// 		}
// 	}
// }
// add_action( 'save_post', 'mfields_set_default_object_terms', 100, 2 );