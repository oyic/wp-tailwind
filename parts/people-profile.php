<div class="people-profile">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="medium-6 cell">
				<?php if(has_post_thumbnail()): ?>
					<?php the_post_thumbnail('medium','class=people-image'); ?>
				<?php else: ?>
					<img src="<?php the_field('barrister_image','option') ?>" alt="<?php the_title() ?>" class="people-image">
				<?php endif; ?>
			</div>
			<div class="medium-6 cell">
				<h1 class="people-name"><?php the_title(); ?></h1>
				<?php get_template_part('parts/people','meta'); ?>
			</div>
		</div>
	</div>
</div>