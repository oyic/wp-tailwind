<?php
/**
 * Category Template
 */
get_header();
?>


<div class="grid-container">
    <div class="grid-x grid-margin-x grid-padding-y" data-equalizer data-equalize-on="medium">
    <div class="cell">
        <h1>
            <?php single_cat_title() ?>
        </h1>
        <div class="category-description">
            <?php echo category_description(); ?>
        </div>
    </div>
        <?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;?>
        <?php query_posts(['page'=>$paged,'posts_per_page'=>20]) ?>
        <?php if (have_posts()): ?>

            <?php while (have_posts()): the_post();?>
                <div class="medium-3 cell" >
                    <div class="card">
                        <div class="items" data-equalizer-watch>
                            <div class="the-date">
                                <?php echo get_the_date('j M, Y'); ?>
                            </div>
                            <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                            <div class="excerpt">
                                <?php echo \Emma\SqeThemeFunctions::excerpt(20); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata();?>
            
            

        <?php else: ?>
            <?php get_template_part('parts/no-content');?>
        <?php endif;?>

    </div>
    <?php global $wp_query; ?>
            <?php if ($wp_query->max_num_pages): ?>
                <div class="grid-x grid-margin-x">
                    <div class="cell">
                        <div class="pagination-container">
                            <?php \Emma\SqeThemeFunctions::paginate($news->max_num_pages);?>
                        </div>

                    </div>
                </div>
            <?php endif;?>
</div>
<?php get_footer();?>