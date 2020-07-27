
<form action="<?php echo admin_url('admin-post.php');?>" class="form-action" method="POST">
	<input type="hidden" name="action" value="print_pdf_file">
	<?php wp_nonce_field( 'verify_nonce_action','verify_of_nonce_field' ); ?>
	<?php global $post; ?>
    <input type="hidden" name="id" value="<?php echo $post->ID ?>">
    <input type="hidden" name="slug" value="<?php echo  $post->post_name; ?>">
    <input type="hidden" name="post_type" value="<?php echo get_post_type(); ?>">
    <input type="hidden" name="pull_pdf" value="1">
	<!-- related sections -->

    <?php if( pods_field('barrister', get_the_ID(), 'related_areas')): ?>
		<input type="hidden" name="relatedsections[]" value='related_areas'>
	<?php endif; ?>
    
    <?php if( pods_field('barrister', get_the_ID(), 'related_cases') ): ?>
        <input type="hidden" name="relatedsections[]" value='related_cases'>
    <?php endif; ?>

    <?php if( pods_field('barrister', get_the_ID(), 'related_posts') ): ?>
        <input type="hidden" name="relatedsections[]" value='related_posts'>
    <?php endif; ?>

	<?php if( pods_field('barrister', get_the_ID(), 'related_events') ): ?>
		<input type="hidden" name="relatedsections[]" value='recent_events'>
	<?php endif; ?>

	<?php if( pods_field('barrister', get_the_ID(), 'related_publications') ): ?>
		<input type="hidden" name="relatedsections[]" value='recent_publications'>
	<?php endif; ?>
    <!-- end-related sections -->
	<?php if(have_rows('area_section')): $x=0; ?>
		<?php while(have_rows('area_section')): the_row(); ?>
		<input type="hidden" name="areasections[]" value='<?php echo $x;?>'>
		<?php $x++; ?>
		<?php endwhile; ?>
	<?php endif; ?>
	<button type="submit" class="admin-form-submit button">Full pdf</button>
</form>



										