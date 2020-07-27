<div class="featured-hero <?php echo get_post_type(); ?>" role="banner" style="background-image:url(<?php the_post_thumbnail_url();?>);background-color:lightgray;"></div>
    <div class="grid-container">
        <div class="grid-x">
            <div class="cell">
                <div class="<?php echo get_post_type(); ?>-header">
                    <div class="title-header">
                        <h1><?php the_title()?></h1>
                        <!-- <div class="description">
                            <?php the_excerpt(); ?>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
</div>