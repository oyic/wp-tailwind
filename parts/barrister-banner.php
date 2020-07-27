<div class="barrister-profile">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="medium-6 cell">
				<?php if(has_post_thumbnail()): ?>
					<?php the_post_thumbnail('medium','class=barrister-image'); ?>
				<?php else: ?>
					<img src="<?php the_field('barrister_image','option') ?>" alt="<?php the_title() ?>" class="barrister-image">
				<?php endif; ?>
			</div>
			<div class="medium-6 cell">
				<?php \Emma\SqeThemeFunctions::get_template_parts_with_vars('parts/barrister-meta',['type'=>'barrister']); ?>

			</div>
		</div>
	</div>
</div>