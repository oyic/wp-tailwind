<?php

$cat = !is_null($cat)?$cat:false;
$class = !is_null($class)?$class:'list logo';
$size = !is_null($size)?$size:'medium';
$title = !is_null($title)?$title:false;

$args = [
	'post_type'   => 'logo',
	'post_status' => 'publish',
	'orderby'     => 'menu_order',
	'order'       => 'ASC'
];

if ($cat !== false) :
	$args['tax_query'] = [
		[
			'taxonomy' => 'logo_category',
			'field'    => 'slug',
			'terms'    => $cat,
		]
	];
endif;

$logos = new WP_Query($args);
    
if ($logos->have_posts()) :?>
	<section class="<?php echo $class;?>">
		<?php if($title): ?>
		<div class="grid-x grid-margin-x grid-margin-y grid-padding-x">
			<div class="cell">
				<h2 class="section-title"><?php echo $title; ?></h4>
			</div>
		</div>
		<?php endif; ?>
		<div class="grid-x grid-padding-x grid-margin-x grid-margin-y small-up-2 medium-up-3 large-up-6">
		<?php while ($logos->have_posts()) : $logos->the_post(); 
			$lid   = get_the_id();
			$title = get_the_title();
			$link  = get_field('url');
			$image = get_field('image');
			?>
			<div class="cell">
				<div class="item-logo">
					<?php if ($link):?>
						<a href="<?php echo $link;?>">
					<?php endif; ?>
						<img src="<?php echo $image['sizes'][$size] ?>" alt="<?php echo $title; ?>" />
					
					<?php if ($link):?>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<?php endwhile;
		wp_reset_postdata(); ?>
		</div>
	</section>
<?php endif; // have post