<?php 
	global $post;
	$cases = \Emma\SqeThemeFunctions::get_related_fields($post->post_type,$post->ID,'related_cases');
	if($cases):?>
	
		<section class="section related section-cases">
			<div class="grid-x grid-padding-x">
				<div class="cell">
					<?php if($title): ?>
						<h2 class="section-title"><?php echo $title?:'Cases'; ?></h2>
					<?php endif; ?>
					
					<ul class="simple cases">
					<?php foreach($cases as $case):?>
						<li>
							<?php \Emma\SqeThemeFunctions::get_title($case);  ?>
						</li>
					<?php endforeach; ?>
					</ul>
					
				</div>
			</div>
		</section>
		
	<?php endif; ?>
