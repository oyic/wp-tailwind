</div> <!-- wrapper -->

<footer id="footer"> 
	<div class="grid-container">
		<div class="grid-padding-x grid-padding-y grid-x">
		    <div class="cell medium-3">
			<?php wp_nav_menu(['theme_location' => 'footer']) ?>
			</div>
			<div class="cell medium-6">
			<?php the_field('footer_text','option'); ?>
			</div>
			<div class="cell medium-3">
				<div class="copyrights">
					&copy; <?php bloginfo('site_name'); ?> <?php echo date('Y');?> All rights reserved.<br />
					Website by <a href="https://Emma.com" target="_blank">Square Eye Ltd</a>.
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>