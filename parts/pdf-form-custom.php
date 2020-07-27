<?php
	$columns = 6;
	if(have_rows('profile_section')){
		$columns = 12/3;
	}
?>
<button class="admin-form-submit button" data-open="custom-pdf">Custom pdf</button>

<div class="reveal <?php echo $columns>4?'small':'reveal-medium'; ?>" id="custom-pdf" data-reveal>
<button class="close-button" data-close aria-label="Close modal" type="button">
  <span aria-hidden="true">&times;</span>
</button>
<h3><?php echo $popup_title?:'Customise PDF' ?></h3>
<form id="form-custom-pdf" action="<?php echo admin_url('admin-post.php');?>" class="form-action" method="POST">
	<input type="hidden" name="action" value="print_pdf_file">
	<?php wp_nonce_field( 'verify_nonce_action','verify_of_nonce_field' ); ?>
	<?php global $post; ?>
    <input type="hidden" name="id" value="<?php echo $post->ID ?>">
    <input type="hidden" name="slug" value="<?php echo  $post->post_name; ?>">
	<input type="hidden" name="post_type" value="<?php echo get_post_type(); ?>">
	<div class="grid-x grid-margin-y grid-margin-x">
		<div class="cell medium-12">
			<a href="#" class="toggle-all">Select all</a> | <a href="#" class="untoggle-all">Unselect all</a>
		</div>
	</div>
	<div class="grid-x grid-margin-x grid-margin-y">

		
		<!-- profile section -->
		<?php if(have_rows('profile_section')): $x=0;?>
		<div class="cell medium-<?php echo $columns;?>">
			<ul class="no-bullet">
			<li><strong>Profile section</strong></li>
				<?php while(have_rows('profile_section')): the_row();?>
					<li>
						<input class="custom-pdf-item" id="profile-section-<?php echo $x;?>" type="checkbox" name="profilesections[]" value='<?php echo $x;?>'> <label for="profile-section-<?php echo $x;?>"><?php the_sub_field('heading');?></label>
					</li>
				<?php $x++;endwhile; ?>
			</ul>
		</div>
		<?php endif; ?>
		<!-- end profile section -->


		<!-- area section -->
		<?php if(have_rows('area_section')): $x=0;?>
		<div class="cell medium-<?php echo $columns;?>">
			<ul class="no-bullet">
			<li><strong>Areas section</strong></li>
			<?php while(have_rows('area_section')): the_row();?>
					<li>
						<input class="custom-pdf-item" id="area-section-<?php echo $x;?>" type="checkbox" name="areasections[]" value='<?php echo $x;?>'> <label for="area-section-<?php echo $x;?>"><?php echo get_sub_field('title_variation')?:get_sub_field('area')->post_title;?></label>
					</li>
				<?php $x++;endwhile; ?>
			</ul>
		</div>
		<?php endif; ?>
		<!-- end area section -->


		
		<div class="cell medium-<?php echo $columns;?>">
		<!-- related sections -->
		<ul class="no-bullet">
			<li><strong>Related contents</strong></li>
			<?php if( pods_field('barrister', get_the_ID(), 'related_areas')): ?>
				<li>
					<input class="custom-pdf-item" id="related_areas" type="checkbox" name="relatedsections[]" value='related_areas'> <label for="related_areas">Related areas</label>
				</li>
			<?php endif; ?>
		
			<?php if( pods_field('barrister', get_the_ID(), 'related_cases') ): ?>
				<li>
					<input class="custom-pdf-item" id="related_cases" type="checkbox" name="relatedsections[]" value='related_cases'> <label for="related_cases">Related cases</label>
				</li>
			<?php endif; ?>

			<?php if( pods_field('barrister', get_the_ID(), 'related_posts') ): ?>
				<li>
					<input class="custom-pdf-item" id="related_posts" type="checkbox" name="relatedsections[]" value='related_posts'> <label for="related_posts">Related news</label>
				</li>
			<?php endif; ?>

			<?php if( pods_field('barrister', get_the_ID(), 'related_events') ): ?>
				<li>
					<input class="custom-pdf-item" id="recent_events" type="checkbox" name="relatedsections[]" value='recent_events'> <label for="recent_events">Recent events</label>
				</li>
			<?php endif; ?>

			<?php if( pods_field('barrister', get_the_ID(), 'related_publications') ): ?>
				<li>
					<input class="custom-pdf-item" id="related_publications" type="checkbox" name="relatedsections[]" value='related_publications'> <label for="related_publications">Related publications</label>
				</li>
			<?php endif; ?>
		</ul>
		<!-- end-related sections -->
		</div>
	</div>

	
	
	
	<button type="submit" class="admin-form-submit button">Generate pdf</button>
</form>
</div>


										