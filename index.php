<?php get_header(); ?>

<div id="wrapper" class="grid-container">
	<?php if(have_posts()): ?>
		<?php while(have_posts()):  the_post();?>
			<?php get_template_part( 'parts/content','title'); ?>
			<article><?php the_content(); ?></article>
		<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>