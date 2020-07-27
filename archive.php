<?php

/**
 * Default Archive
 */

get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="grid-container">
    <div class="grid-x grid-margin-x">
        <div class="medium-4 cell">
            <h3><?php the_title(); ?></h3>
            <div class="content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>
<?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>
<?php get_footer(); ?>