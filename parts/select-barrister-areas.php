<?php 
$args = ['post_type'=>'area',
		 'post_status'=>'publish',
		 'orderby' => 'title',
         'order' => 'ASC',];
$areas = new WP_Query($args);

?>
<?php if($areas->have_posts()): ?>
	<select name="b_area" id="filter-barristers-area" class='select-action'>
		<option value=""><?php echo $default_option_label?:'Areas' ?></option>
		<?php while($areas->have_posts()): $areas->the_post(); ?>
			<?php global $post; ?>
			<option value="<?=$post->post_name?>"  <?php echo isset($_REQUEST['b_area']) && ($_REQUEST['b_area']) === $post->post_name ? 'selected': '' ?> ><?=$post->post_title;?></option>
		<?php endwhile; ?>
	</select>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>