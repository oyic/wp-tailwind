<?php  /** Testimonials - slick slider */ ?>
 
<?php if(have_rows('testimonials')): ?>

<section class="section related section-testimonials">
	<div class="grid-x grid-padding-x">
		<div class="cell">
			
			<div class="testimonial-slider">
			<?php while(have_rows('testimonials')): the_row(); ?>
				<div class="testimonial">
					<div class="quote"><?php the_sub_field('quote'); ?></div>
					<div class="source"><?php the_sub_field('source'); ?></div>
				</div>
			<?php endwhile; ?>
			</div>
			
		</div>
	</div>
</section>

<?php endif; ?>