<?php 

$cpt = !is_null($cpt)?$cpt:'post';
$tax = !is_null($tax)?$tax:'category';
$terms =!is_null($terms)?$term:false;
$gridclass = !is_null($gridclass)?$class:'grid-class small-up-2 medium-up-3 large-up-4';
$title = !is_null($title)?$title:false;
$limit = !is_null($limit)?$limit:-1;
$cellclass = !is_null($cellclass)?$cellclass:"cell-class";
            
// WP_Query arguments
$args = array(
    'post_type'              => array($cpt),
    'nopaging'               => true,
    'posts_per_page'         => $limit,
    'order'                  => 'ASC',
    'orderby'                => 'post_title',
);
if(!is_empty($tax) && $terms != false):
    $args['tax_query'] = [
		[
			'taxonomy' => $tax,
			'field'    => 'slug',
			'terms'    => $terms,
		]
	];
endif;

// The Query
$records = new WP_Query( $args );
	
// The Loop
if ( $records->have_posts() ):?>
    <div class="images section">
        <?php if($title!=false): ?>
            <div class="grid-x grid-margin-x grid-margin-y">
				<h3><?php echo $title;?></h3>
			</div>
        <?php endif; ?>
        <div class="grid-x grid-margin-x grid-margin-y <?php echo $gridclass;?>" data-equalizer>
            <?php while($records->have_posts()): $records->the_post(); ?>
                <div class="cell">
                    <div class="<?php echo $cellclass" data-equalizer-watch>
                    <a href="<?php the_permalink();?>"  >
                        <?php the_post_thumbnail('landscape'); ?>
                        <span class="title"><?php the_title(); ?></span>
                    </a>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
<?php endif; ?>
