<?php 
$class = !is_null($class)?$class:'list logo';
$size = !is_null($size)?$size:'medium';
$title = !is_null($title)?$title:false;

?>
<?php if(have_rows('logo')):?>
<section class="<?php echo $class;?>">
		<?php if($title): ?>
			<div class="grid-x grid-margin-x grid-margin-y grid-padding-x">
				<div class="cell">
					<h2 class="section-title"><?php echo $title; ?></h4>
				</div>
			</div>
		<?php endif; ?>
		<div class="grid-x grid-padding-x grid-margin-y small-up-2 medium-up-3 large-up-6">
				<?php while(have_rows('logo')): the_row();?>
					<div class="cell">
						<div class="item-logo item-flex-center">
							<?php 	
								$image = get_sub_field('image');
								$link  = get_sub_field('url');
								
							 ?>
							<?php if ($link):?>
								<a href="<?php echo $link;?>">
							<?php endif; ?>
							
								<img src="<?php echo $image['sizes'][$size] ?>" alt="Logo" />
								
							<?php if ($link):?>
								</a>
							<?php endif; ?>

						</div>
					</div>
				<?php endwhile; ?>
		</div>
	</section>
<?php endif; ?>