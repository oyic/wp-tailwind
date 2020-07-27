<?php 
	global $post;
	$barristers = \Emma\SqeThemeFunctions::get_related_fields('area',$post->ID,'related_barristers');
	if($barristers):?>
		<div class="related-barristers">
			<div class="grid-x grid-margin-x">
				<div class="cell">
					<h3 class="practice-barristers"><?php echo $title?:'Barristers';?></h3>
					<ul class="item lists no-bullet">
					<?php foreach($barristers as $barrister):?>
						<li>
							<?php \Emma\SqeThemeFunctions::get_title($barrister);  ?>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; ?>
