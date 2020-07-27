<?php if(get_field('download')): ?>
    <a href="<?php the_field('download');?>" class="button" download>Download</a>
<?php endif; ?>
<?php if(get_field('url')): ?>
    <a href="<?php the_field('url');?>" class="button" target="_blank">Website</a>
<?php endif; ?>