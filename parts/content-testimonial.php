<?php 
/** Barristers Testimonials - slick slider */
 ?>
<?php if(have_rows('testimonials')): ?>
<div class="barrister-testimonial">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
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
	</div>
</div>
<?php endif; ?>