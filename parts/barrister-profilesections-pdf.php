
<?php if (have_rows('profile_section') && (isset($_REQUEST['profilesections']) || isset($_REQUEST['pullpdf']) )): $index = 0;?>
<?php $indexes = explode(",",$_REQUEST['profilesections']);?>
		<div class="profile-sections">
			<?php if ($title): ?>
				<div class="grid grid-margin-x">
					<div class="cell">
						<h3 class="section-title">
							<?php echo $title; ?>
						</h3>
					</div>
				</div>
			<?php endif;?>
			<div class="grid-x grid-margin-x">
				<div class="cell">
					<?php while (have_rows('profile_section')): the_row();?>
							<?php if ( in_array($index, $indexes) || isset($_REQUEST['pullpdf'])): ?>
								<div class="section">
									<h4 class="item-title">
										<?php the_sub_field('heading');?>
									</h4>
									<div class="content">
										<?php the_sub_field('text');?>
									</div>
								</div>
							<?php endif;?>
						<?php $index++;?>
					<?php endwhile;?>
				</div>
			</div>
	</div>
<?php endif;?>