
<?php if (have_rows('area_section')):?>

	<div class="area-sections">
		<div class="grid-x grid-padding-x">
				<div class="cell">
					<h2 class="section-title"><?php echo $title; ?></h2>
				</div>
		</div>

		<?php while(have_rows('area_section')): 
			the_row(); 
			$area = get_sub_field('area');

		?>
			<section class="section">
				<div class="grid-x grid-padding-x">
					<div class="cell">
						<h3>
							<?php 
							if(get_sub_field('title_variation')) {
								the_sub_field('title_variation');
							} else {
								
								echo $area->post_title;
							}
							?>
						</h3>
						<div class="text">
							<?php the_sub_field('text'); ?>
						</div>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
				
	</div>
	
<?php endif; ?>