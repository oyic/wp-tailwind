<?php /*if(have_rows('logo')):?>
	<div class="content-logos">
			<div class="grid-x grid-margin-x">
				<div class="cell">
					<?php if($title): ?>
						<h4 class="related-title"><?php echo $title; ?></h4>
					<?php endif; ?>
					
					<ul class="item lists no-bullet flex-container">
					<?php while(have_rows('logo')): the_row();?>
						<li>
							<?php \Emma\SqeThemeFunctions::imageLink( get_sub_field('url')?:'#', get_sub_field('image'), true);  ?>
						</li>
					<?php endwhile; ?>
					</ul>
					
				</div>
			</div>
		</div>
<?php endif; */?>
<?php if(have_rows('logo')):?>
<section class="section related section-logos">
		<?php if($title): ?>
			<div class="grid-x grid-margin-x grid-margin-y grid-padding-x">
				<div class="cell">
					<h2 class="section-title"><?php echo $title; ?></h4>
				</div>
			</div>
		<?php endif; ?>
		<div class="grid-x grid-padding-x small-up-2 medium-up-4 large-up-6">
				<?php while(have_rows('logo')): the_row();?>
					<div class="cell">
					<?php \Emma\SqeThemeFunctions::imageLink( get_sub_field('url')?:'#', get_sub_field('image'), true);  ?>
					</div>
				<?php endwhile; ?>
		</div>
	</section>
<?php endif; ?>