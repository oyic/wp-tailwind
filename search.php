<?php
get_header(); ?>

<?php
/** To modify search results of use filter pre_get_posts */
// $args = ['post_type'=>'any','post_status'=>'publish']
// query_post($args);
?>
<!-- Standard Image banner 1200x300 -->
<!-- <?php get_template_part('parts/featured', 'image'); ?> -->
<div class="grid-container">
<div class="grid-x grid-margin-x">
<div class="cell">
<h1>Search results</h1>
</div>
</div>
    <div class="grid-x grid-margin-x">
        <div class="medium-8 cell">
            <?php if (have_posts()) : ?>
                <h2>You searched for <?php the_search_query();?></h2>
                <div class="content">
                    <ul class="no-bullet">

                        <?php while (have_posts()) : the_post(); ?>
                        <li>
                            <div class="item-result">
                                <div class="grix-x">
                                   
                                    <div class="cell medium-8">
                                        <div class="text">
                                            <div class="title">
                                                <a href="<?php the_permalink();?>"><?php the_title() ?></a>
                                                <?php if('post'==get_post_type()): ?>
                                                    <div class="date">
                                                        <?php echo get_the_date('j M, Y'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="excerpt">
                                                <?php echo \Emma\SqeThemeFunctions::content(20); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(has_post_thumbnail()): ?>
                                        <div class="cell medium-4">
                                            <div class="featured-image">
                                                <?php the_post_thumbnail('thumbnail'); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
            <?php else : ?>
                <div class="content">
                    <?php get_template_part('parts/search', 'empty'); ?>
                </div>
            <?php endif; ?>

        </div>
        <div class="medium-4 cell">
            <?php //get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>