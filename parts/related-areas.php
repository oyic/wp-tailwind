<?php 
	global $post;
	$areas = \Emma\SqeThemeFunctions::get_related_fields($post->post_type,$post->ID,'related_areas');
	if($areas):?>
	 
		<section class="section related related-areas">
			<div class="grid-x grid-padding-x">
				<div class="cell">
					<?php if($title): ?>
						<h2 class="section-title"><?php echo $title; ?></h2>
					<?php endif; ?>
					<ul class="simple">
					<?php foreach($areas as $area):?>
						<li>
							<?php \Emma\SqeThemeFunctions::get_title($area);  ?>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</section>

<?php endif; ?>
