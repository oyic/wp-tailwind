<?php
/** 
* This is a multipurpose related parts that calls up SqeThemeFunctions::get_related_field()
* 
* called: via 
* SqeThemeFunctions::get_template_parts_with_vars('parts/related-parts',['title'=>'Related news','cpt'=>'post | optional','id'=>'optional',is_])
* 
*/


$columns = !is_null($columns)?12/$columns: 'lists' ;
$id      = !is_null($id)?$id             : get_the_ID();
$cpt     = !is_null($cpt)?$cpt           : get_post_type();
$orderby = !is_null($orderby)?$oderby    : 'post_date';
$order   = !is_null($order)?$order       : 'DESC';

if(is_null($related_field)) return new WP_Error( 'missing', __( "Missing related_field parameter", "sqe" ) );

$related_ids = \Emma\SqeThemeFunctions::get_related_field($cpt,$id,$related_field,$orderby,$order);

if($related_ids):?>
    <div class="grid-x grid-margin-x grid-margin-y">
        <?php if('lists'== $columns): ?>
            <div class="cell">
                <ul class="lists <?php echo $cpt;?>">
                    <?php foreach($related_ids as $id):?>
                        <li>
                            <a href="<?php the_permalink($id); ?>"><?php echo get_the_title($id); ?></a> <span class="date"> <?php echo get_the_date('j M, Y'); ?></span>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php else: ?>
            <?php foreach($related_ids as $id):?>
                <div class="cells medium-<?php echo $columns;?>">
                   <div class="item item-<?php echo $cpt;?>">
                        
                        <?php if($is_image && has_post_thumbnail($id)) :?>
                            <div class="image">
                                <?php the_post_thumbnail($id,'thumbnail'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="title">
                            <?php echo get_the_title($id); ?>
                        </div>

                        <?php if($is_date): ?>
                            <div class="date">
                                <?php echo get_the_date('j M, Y'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="excerpt">
                            <?php echo \Emma\SqeThemeFunctions::excerpt(15); ?>
                        </div>

                        <a href="<?php the_permalink($id); ?>" class="read-more">Read more</a>
                   </div>
                </div>
            <?php endforeach;?>
        <?php endif; ?>
    </div>
    <?php
endif;


