<?php 
	global $post;
	$events = \Emma\SqeThemeFunctions::get_related_fields($post->post_type,$post->ID,'related_events');
	if($events):?>
		<section class="section related section-events">
			<div class="grid-x grid-padding-x">
				<div class="cell">
					<?php if($title): ?>
						<h2 class="section-title"><?php echo $title?:'Events'; ?></h3>
					<?php endif; ?>
					
					<ul class="simple events">
					<?php foreach($events as $event):?>
						<li>
							<?php \Emma\SqeThemeFunctions::get_title($event);  ?>
						</li>
					<?php endforeach; ?>
					</ul>
					
				</div>
			</div>
		</section>
		
	<?php endif; ?>
