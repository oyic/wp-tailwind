<?php

/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes();?>>

<head>
	<meta charset="<?php bloginfo('charset');?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<?php wp_head();?>
</head>

<body  <?php body_class('bg-gray-500');?>>
	<?php do_action('after_body_open_tag');?>
	<?php get_template_part('parts/admin', 'template');?>
	
	
	<div id="wrapper">
		<header class="site-header grid-container">
			<div class="grid-x grid-padding-x grid-padding-y">
				<div class="cell medium-2">
				<?php if (get_field('logo', 'option')): ?>
					<a href="<?php bloginfo('site_url')?>">
						<img src="<?php the_field('logo', 'option');?>" alt="Logo" class="logo">
					</a>
				<?php else: ?>
					<a href="<?php bloginfo('site_url')?>">
						<img src="https://via.placeholder.com/300x80&text=Logo" alt="Logo" class="logo">
					</a>
				<?php endif;?>
				</div>
				<div class="cell medium-10">
					
				<div class="top-bar" id="menu-wrapper">
					<div class="top-bar-right">
						<?php wp_nav_menu(array(
								'container' => false,
								'menu' => 'Main menu',
								
								'menu_class' => 'medium-horizontal menu',
								'theme_location' => 'primary',
								'items_wrap' => '<ul id="%1$s" class="%2$s" data-alignment="right" data-responsive-menu="drilldown medium-dropdown" style="width: 100%;">%3$s</ul>',
								//Recommend setting this to false, but if you need a fallback...
								'fallback_cb' => 'f6_drill_menu_fallback',
								'walker' => new F6_DRILL_MENU_WALKER(),
							));?>
					</div>
				</div>
			</div>
	</div>

	</header>

	