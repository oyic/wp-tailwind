<aside class="sidebar sidebar-right">
	<?php

	 $current_parrent_id = wp_get_post_parent_id( get_the_ID() );
	 $parent = get_post($parent_id);
	 
	 if(!$parent_id):
		$parent_id = get_the_ID();
		$parent = $post;
	 endif;
	 

	 ?>
	 
	<div class="widget">
		<?php wp_nav_plus(
			array(
				'theme_location' => 'primary',
				'segment'=>'About us',
				'menu_class'=>'sidebar-menu'
			)
		);?>
	</div>
	
</aside>