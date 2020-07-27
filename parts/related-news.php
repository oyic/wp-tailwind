<?php 
	global $post;
	$news = \Emma\SqeThemeFunctions::get_related_fields($post->post_type,$post->ID,'related_posts');
	if($news):?>
	
		<section class="section related section-news">
			<div class="grid-x grid-margin-x grid-padding-x grid-margin-y">
				<div class="cell">
					<?php if($title): ?>
						<h2 class="section-title"><?php echo $title; ?></h2>
					<?php endif; ?>
					
					<ul class="simple news">
					<?php foreach($news as $new):?>
						<li>
							<?php \Emma\SqeThemeFunctions::get_title($new);  ?>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</section>
		
	<?php endif; ?>
