<?php if (have_rows('profile_section')):?>

	<div class="profile-sections">
		
		<?php if($title): ?>
			<div class="grid-x grid-padding-x">
				<div class="cell">
					<h2 class="section-title"><?php echo $title; ?></h2>
				</div>
			</div>
		<?php endif; ?>	
					
		<?php while(have_rows('profile_section')): the_row(); ?>
		
			<section class="section profile-section">
				<div class="grid-x grid-padding-x">
					<div class="cell">
						<h3><?php the_sub_field('heading'); ?></h3>
						<div class="text">
							<?php the_sub_field('text'); ?>
						</div>
					</div>
				</div>
			</section>
			
		<?php endwhile; ?>
		
	</div>
	
<?php endif; ?>