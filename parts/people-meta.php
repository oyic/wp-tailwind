<?php if(get_field('job_title')):?>
   <div class="position"><span class="hide-for-small-only">Position</span> <?php the_field('job_title'); ?></div>
<?php endif; ?>
<?php if(get_field('phone') || get_field('mobile') || get_field('email')): ?>
<div class="people__contact">
    <?php if(get_field('phone')):?>
        <div class="phone"><span class="hide-for-small-only">Phone: </span> <?php \Emma\SqeThemeFunctions::phone_link(get_field('phone')); ?></div>
    <?php endif;?>
    <?php if(get_field('mobile')):?>
        <div class="mobile"><span class="hide-for-small-only">Mobile: </span> <?php \Emma\SqeThemeFunctions::phone_link(get_field('mobile')); ?></div>
    <?php endif;?>
    <?php if(get_field('email')):?>
        <div class="email"><span class="hide-for-small-only">Email: </span> <?php \Emma\SqeThemeFunctions::email_link(get_field('email')); ?></div>
    <?php endif;?>
</div>
<?php endif; ?>