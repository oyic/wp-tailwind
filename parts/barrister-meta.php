<div class="meta">
	<?php if($type == 'archive') : ?>
		<div class="call-silk">
			<?php if(get_field('call_year') && get_field('call_year')>0): ?>
				Call: <span class="value"><?php the_field('call_year');?></span>
					<?php if(get_field('extra_call_year')): ?>
						| <em><?php the_field('extra_call_year') ?></em>
					<?php endif; ?>
				<?php if(get_field('extra_call_year') && (get_field('silk_year') && get_field('silk_year')>0)): ?>
						<br>
							Silk: <span class="value"><?php the_field('silk_year');?></span>
				<?php elseif(get_field('silk_year') && get_field('silk_year')>0): ?>
						Silk: <span class="value"><?php the_field('silk_year');?></span>
				<?php endif; ?>
			<?php endif; ?>
			
		</div>
	<?php else: ?>
		<h1 class="barrister-name"><?php the_title(); ?></h1>
		<div class="call-silk">
			<?php if(get_field('call_year') && get_field('call_year')>0): ?>
				Call: <span class="value"><?php the_field('call_year');?></span>
					<?php if(get_field('extra_call_year')): ?>
						| <em><?php the_field('extra_call_year') ?></em>
					<?php endif; ?>
				<?php if(get_field('extra_call_year') && (get_field('silk_year') && get_field('silk_year')>0)): ?>
						<br>
							Silk: <span class="value"><?php the_field('silk_year');?></span>
				<?php elseif(get_field('silk_year') && get_field('silk_year')>0): ?>
						Silk: <span class="value"><?php the_field('silk_year');?></span>
				<?php endif; ?>
			<?php endif; ?>
			<?php if(get_field('trading_name')): ?>
				<div class="trading-name"><?php the_field('trading_name') ?></div>
			<?php endif ?>
			<?php if(get_field('vat_number')): ?>
				<div class="vat-number">Vat: <span><?php the_field('vat_number') ?></span></div>
			<?php endif ?>
		</div>
		<?php if(get_field('phone') || get_field('mobile') || get_field('email') ) :?>
		<div class="contact">
			<?php if(get_field('phone')): ?>
				<div class="phone">Phone: <span><?php \Emma\SqeThemeFunctions::phone_link(get_field('phone')); ?></span></div>
			<?php endif; ?>
			<?php if(get_field('mobile')): ?>
				<div class="mobile">Mobile: <span><?php \Emma\SqeThemeFunctions::phone_link(get_field('mobile')); ?></span></div>
			<?php endif; ?>
			<?php if(get_field('email')): ?>
				<div class="email">Email: <span>
					<?php \Emma\SqeThemeFunctions::anchor_link(get_field('email'));?>
						
					</span></div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if(have_rows('social')): ?>
			<div class="social">
				<?php while(have_rows('social')): the_row(); ?>
					<div class="social">
						<?php the_sub_field('name'); ?>
						: <span><?php \Emma\SqeThemeFunctions::anchor_link(get_sub_field('account_url'),false,true);?></span>		
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	<?php if(!isset($_REQUEST['mode'])): ?>
		<?php \Emma\SqeThemeFunctions::get_template_parts_with_vars('parts/pdf-form-full',['button_label'=>'Generate PDF']); ?>
		<?php \Emma\SqeThemeFunctions::get_template_parts_with_vars('parts/pdf-form-custom',['button_label'=>'Custom PDF','popup_title'=>'Customise pdf download']); ?>
		<?php \Emma\SqeThemeFunctions::get_template_parts_with_vars('parts/vcard',['label'=>'Download vcard']); ?>
	<?php endif; ?>
	<?php endif; ?>
</div>