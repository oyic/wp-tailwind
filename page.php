<?php 
/**
 * Default page
 */

get_header(); ?>

<?php if(have_posts()): ?>

	<?php while(have_posts()): the_post(); ?>
	
		<?php get_template_part( 'parts/featured', 'image' ); ?>
		<div class="section content">
			<div class="grid-container">
				<div class="grid-x grid-margin-x">
					
					<div class="medium-8 cell">	
								<div class="content">
									<?php get_template_part('parts/crumbs'); ?>
									<?php the_content(); ?>
									<?php get_template_part('parts/share'); ?>
								</div>
						<?php //get_template_part('parts/accordion','section') ?>	
					</div>
					
					<div class="medium-4 cell">
						<?php get_sidebar('right');?>
					</div>
					
				</div>
			</div>

		</div>
		
	<?php 
		endwhile; 
		wp_reset_postdata();
		endif; 
	?>
		
<?php get_footer(); ?>
