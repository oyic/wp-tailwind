<?php 
	if(!get_field('hide_contact_panel')):?>

		<div class="contact-panel">
			<h2>Contact</h2>
		<?php if(get_field('contact_panel_text') && get_field('contact_panel_person')): ?>
			<p><?php the_field('contact_panel_text');?></p>
			<?php $contact = get_field('contact_panel_person'); ?>
		<?php else: ?>
			<p><?php the_field('contact_panel_default_text','option');?></p>
			<?php $contact = get_field('contact_panel_default_person','option') ?>
		<?php endif; ?>
		
		<?php $contact->ID;
				$email = get_post_meta( $contact->ID, 'email', true );
				$phone = get_post_meta( $contact->ID, 'phone', true );
				$mobile = get_post_meta( $contact->ID, 'mobile', true );
				
				function MakePhoneNumberClickable($num) {
					$num = str_replace('(0)20','20',$num);
					$num = str_replace(' ','',$num);
					return $num;
				} 
			?>
		
		 
		<div class="row">
			<div class="small-3  columns">
				<?php if(has_post_thumbnail($contact->ID)): ?>
				<img src="<?php echo get_the_post_thumbnail_url( $contact->ID, 'thumbnail' ); ?>" alt="<?php echo $contact->post_title; ?>" class="contact-person">
			<?php endif; ?>
			</div>
			<div class="small-9 columns info">
				<div class="name"><span><strong><?php echo $contact->post_title; ?></strong></span></div>
				<?php if(get_post_meta( $contact->ID, 'job_title', true )) :?>
					<div class="name"><span><strong><?php echo get_post_meta( $contact->ID, 'job_title', true ); ?></strong></span></div>
				<?php endif; ?>
				<?php if($phone) :?>
					<div class="name">Phone: <span><a href="tel:<?php echo MakePhoneNumberClickable($phone); ?>"><?php echo $phone; ?></a></span></div>
				<?php endif; ?>
				<?php if($mobile) :?>
					<div class="name">Mobile: <span><a href="tel:<?php echo MakePhoneNumberClickable($mobile); ?>"><?php echo $mobile; ?></a></span></div>
				<?php endif; ?>
				<?php if($email) :?>
					<div class="name">Email: <span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span></div>  
				<?php endif; ?>
			</div> 
 
			</div>
		</div>
		
		</div>
		
	<?php endif; ?>

