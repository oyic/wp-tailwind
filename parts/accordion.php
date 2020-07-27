<?php 
/**
 * This assumes there is a section ACF for the current page or post
 */
 ?>
<?php if(have_rows('section')): ?>
<ul class="accordion" data-accordion data-allow-all-closed="true">
    <?php while(have_rows('section')): the_row(); ?>

        <li class="accordion-item <?php echo get_sub_field('active')?'is-active':''?>" data-accordion-item>
            <a href="#" class="accordion-title"><?php the_sub_field('title') ?></a>

            <div class="accordion-content" data-tab-content>
                <?php the_sub_field('text'); ?>
            </div>
        </li>

<?php endwhile; ?>
</ul>
<?php endif ?>