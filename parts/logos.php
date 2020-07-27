<?php if(have_rows('logo')):?>
<section class="section related section-logos">
		<div class="grid-x grid-padding-x">
			<div class="cell">
				<?php if($title): ?>
					<h2 class="section-title"><?php echo $title; ?></h4>
				<?php endif; ?>
				
				<ul class="menu logos">
				<?php while(have_rows('logo')): the_row();?>
					<li><?php \Emma\SqeThemeFunctions::imageLink( get_sub_field('url')?:'#', get_sub_field('image'), true);  ?></li>
				<?php endwhile; ?>
				</ul>
				
			</div>
		</div>
	</section>
<?php endif; ?>