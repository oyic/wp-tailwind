
<?php if (have_rows('area_section')):?>
	<div class="area-sections">
		<div class="grid-x grid-margin-x">
				<div class="cell">
					<h3 class="section-title">
						<?php echo $title; ?>
					</h3>
				</div>
		</div>
			<div class="grid-x grid-margin-x">
				<div class="cell">
					<?php while(have_rows('area_section')): the_row(); ?>
						<div class="section">
							<h4 class="item-title">
								<?php if(get_sub_field('title_variation')): ?>
									<?php the_sub_field('title_variation'); ?>
								<?php else: ?>
									<?php $area = get_sub_field('area'); ?>
									<?php echo $area->post_title;?>
								<?php endif; ?>
							</h4>
							<div class="content">
								<?php the_sub_field('text'); ?>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
	</div>
<?php endif; ?>