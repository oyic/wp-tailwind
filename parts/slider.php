<?php
    $limit = !is_null($limit)?$limit:-1;
    $type = !is_null($type)?$type:'slick';
    $args = ['post_type'=>'slider','posts_per_page'=>$limit,'post_status'=>'pubish'];
    if(!is_null($cat)):
        $args['tax_query'] = [
            [
                'taxonomy' => 'slider_category',
                'field' => 'slug',
                'terms' => $cat
            ]
        ];
    endif;
    $slides = new WP_Query($args);
    if($slides->have_posts()):?>
        <?php if('slick'==$type): ?>
            <div class="slider">
                <?php while($slides->have_posts()): $slides->the_post(); ?>
                <?php $image = get_field('image');?>
                    <div class="slider-image" style="height:500px; background-image:url(<?php echo $image['sizes']['large'];?>);">
                    <?php if (get_field('url')): ?>
                                    <a class="slide-link" href="<?php the_field('url');?>">
                                <?php endif;?>
                                <?php if (get_field('caption')): ?>
                                        <div class="caption">
                                            <?php the_field('caption')?>
                                        </div>
                                    <?php endif;?>
                                <?php if (get_field('url')): ?>
                                    </a>
                                <?php endif;?>
                            </li> 
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else: ?>
            <div class="orbit" role="region" aria-label="Image Slides" data-orbit>
                <div class="orbit-wrapper">
                    <div class="orbit-controls">
                        <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
                        <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
                    </div>
                    <ul class="orbit-container">
                        <?php while($slides->have_posts()): $slides->the_post(); ?>
                            <li class="orbit-slide">
                                <?php if (get_field('url')): ?>
                                    <a href="<?php the_field('url');?>">
                                <?php endif;?>
                                <figure class="orbit-figure">
                                    <?php $image = get_field('image');?>
                                    <img src="<?php echo $image['sizes']['large'] ?>" alt="Slide" class="orbit-image">
                                    <?php if (get_field('caption')): ?>
                                        <figcaption class="orbit-caption">
                                            <?php the_field('caption')?>
                                        </figcaption>
                                    <?php endif;?>
                                </figure>
                                <?php if (get_field('url')): ?>
                                    </a>
                                <?php endif;?>
                            </li>
                    
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
        <?php   endif; ?>
    <?php endif; ?>