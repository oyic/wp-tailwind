<?php 
	global $post;
	$publications = \Emma\SqeThemeFunctions::get_related_fields($post->post_type,$post->ID,'related_publications');
	if($publications):?>
		<div class="related-publications">
			<div class="grid-x grid-margin-x">
				<div class="cell">
					<?php if($title): ?>
						<h4 class="related-title"><?php echo $title?:'Publications'; ?></h4>
					<?php endif; ?>
					<ul class="item lists no-bullet">
					<?php foreach($publications as $pub):?>
						<li>
							<?php \Emma\SqeThemeFunctions::get_title($pub);  ?>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>
