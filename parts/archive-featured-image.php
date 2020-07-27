<?php if(get_field(get_post_type().'_banner','option')):?>
		<div class="featured-hero <?php echo get_post_type(); ?>" role="banner" style="background-image:url(<?php the_field(get_post_type().'_banner','option');?>)"></div>
			<?php if(get_field(get_post_type().'_archive_title','option')) : ?>
				<div class="grid-container">
					<div class="grid-x grid-padding-y">
						<div class="cell">
							<div class="archive-header">
								<div class="title-header">
									<h1><?php the_field(get_post_type().'_archive_title','option')?></h1>
									<div class="description">
										<?php the_field(get_post_type().'_archive_description','option') ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
		<?php else: ?>
			<div class="featured-hero <?php echo get_post_type(); ?>" role="banner" style="background-color:<?php the_field(get_post_type().'_background','option');?>">
				<?php if(get_field(get_post_type().'_archive_title','option')) : ?>
					<div class="grid-container">
						<div class="grid-x">
							<div class="cell">
								<div class="archive-header">
									<div class="title-header">
										<h1><?php the_field(get_post_type().'_archive_title','option')?></h1>
										<div class="description">
											<?php the_field(get_post_type().'_archive_description','option') ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif ?>
			</div>
		<?php endif; ?>