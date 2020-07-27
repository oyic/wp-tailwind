<?php 
/**
 * Template Name: Homepage Template
 * Template for front-page
 */

get_header(); ?>
<?php if(have_posts()):  ?>
	<?php while(have_posts()): the_post(); ?>
	<!-- Standard Image banner 1200x300 -->
		<?php //get_template_part( 'parts/featured', 'image' ); ?>
		<?php \Emma\SqeThemeFunctions::get_template_parts_with_vars('parts/slider',['limit'=>3,'cat'=>'front']) ?>
		<?php //get_template_part('parts/content','title') ?>
		<div class="grid-container">
			<div class="grid-x grid-margin-x">
				<div class="medium-12 cell">
						<div class="content">
							<?php the_content(); ?>
						</div>		
				</div>
			</div>
		</div>
	<?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>

<?php get_footer(); ?>
