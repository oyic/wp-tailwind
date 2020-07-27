<?php
namespace Emma;

class Ajax
{
    private static $ajax_hooks = ['filter_posts'=>true]; // = [ 'ajax_action' => true ]
    
    public static function load()
    {
        foreach (self::$ajax_hooks as $ajax => $nopriv) {
            add_action("wp_ajax_".$ajax, [__CLASS__,$ajax."_action"]);
            if ($nopriv) {
                add_action("wp_ajax_nopriv_".$ajax, [__CLASS__,$ajax."_action"]);
            }
        }
    }
    /**
     * return the form element for the wp_ajax action field
     * @param  [type] $action [description]
     * @return [type]         [description]
     */
    public static function ajax_form_element($action)
    {
        $retval = wp_nonce_field("validate_form_action", "field_validate_form");
        $retval.= '<input type="hidden" name="action" value="'.$action.'">';
        echo $retval;
    }
    
    /**
     * use to validate nonce field
     * @return [type] [description]
     */
    public static function validate_subimitted_form()
    {
        if (! isset($_REQUEST['field_validate_form']) ||
        ! wp_verify_nonce($_REQUEST['field_validate_form'], 'validate_form_action')) :
           print 'Sorry, your nonce did not verify.';
        return false;
        exit;
        endif;
        return true;
    }
    public static function filter_posts_action()
    {
        $paged = isset($_REQUEST['paged']) ? $_REQUEST['paged']: 1;
        $cat = isset($_REQUEST['cat'])?$_REQUEST['cat']:false;
        $b = isset($_REQUEST['b'])?$_REQUEST['b']:false;
        $a = isset($_REQUEST['area'])?$_REQUEST['area']:false;
        $kw = isset($_REQUEST['key'])?$_REQUEST['key']:false;
        $retval = [];
        /** default args */
        $args=[
            'post_type'      => 'post',
            'posts_per_page' => 12,
            'post_status'    => 'publish',
            'orderby'        => 'post_date',
            'order'          => 'DESC',
            'paged'           => $paged
            ];
        
        /** Category */
        if($cat) {
            $args['category_name'] = $cat;
        }

        /** Barrister */
        if($b){
            // Grab all posts ids related to this barrister id
            $related_barrister_posts = pods_field('barrister',$b,'related_posts')?:[];

            $b_ids =  array_map(function ($related_field) {
                return $related_field['ID'];
            }, $related_barrister_posts);
        }

        /** Area */
        
        if($a){
            // Grab all posts ids related to this barrister id
            $related_area_posts = pods_field('area',$a,'related_posts')?:[];

            $a_ids =  array_map(function ($related_field) {
                return $related_field['ID'];
            }, $related_area_posts);
        
        }

        if($a && $b){
            // both area & barrister is selected
            $related_combined = array_intersect($a_ids,$b_ids);
            $related_posts = sizeof($related_combined)>0?$related_combined:[-1];
        }
        else{
            // only 1 of was selected (area or barrister)
            if($a){
               $related_posts = sizeof($a_ids)>0?$a_ids:[-1];

            }
            if($b){
                $related_posts = sizeof($b_ids)>0?$b_ids:[-1];
             }
        }

        /** load in post__in parameter to either area or barrister */
        if($a || $b){
            $args['post__in'] = $related_posts;
        }

        /** keywords */
        if($kw){
            $args['s'] = $kw;
        }

        if(function_exists('relevanssi_do_query')):
            $records = new \WP_Query();
            $records->parse_query( $args );
            relevanssi_do_query( $records );
        else:
            // Normal Query
            $records = new \WP_Query($args);
        endif;
        if($records->have_posts()):
            
            $retval['success'] = true;
            
            while($records->have_posts()): $records->the_post();
                $retval['records'][] = [
                    'permalink'      => get_the_permalink(),
                    'title'          => get_the_title(),
                    'featured_image' => has_post_thumbnail() ? get_the_post_thumbnail('medium') : 'https://loremflickr.com/640/360',
                    'excerpt'        => trim(strip_tags(\Emma\SqeThemeFunctions::content(15))),         
                    'date'           => get_the_date('j M, Y',get_the_ID())
                ];
            endwhile; wp_reset_postdata();
            //Pagination
            $cat = isset($_REQUEST['cat'])?$_REQUEST['cat']:false;
            $b = isset($_REQUEST['b'])?$_REQUEST['b']:false;
            $a = isset($_REQUEST['area'])?$_REQUEST['area']:false;
            $kw = isset($_REQUEST['key'])?$_REQUEST['key']:false;
            $page_args = ['page'=>$paged,'cat'=>$_REQUEST['cat'],'b'=>$_REQUEST['b'],'area'=>$_REQUEST['area'],'key'=>$_REQUEST['key']];
            $retval['pagination'] = self::ajax_paginate($records,$page_args);
            $retval['sql'] = $args;
        else:
            
            $retval['success'] = false;
            $retval['err_msg'] = 'No posts found';
            if($cat):
                $obj = get_category_by_slug( $cat );
                $retval['err_msg'] = 'No '.$obj->name.' found';
            endif;
            if($b) $retval['err_msg'] .= ' for '. get_the_title($b);
            
            if($a) :
                if($b) $retval['err_msg'] .= ' and '. get_the_title($a);
                else $retval['err_msg'] .= ' for '. get_the_title($a);
            endif;

            if($kw) $retval['err_msg'] .= ' having <em>'.$kw .'</em>';

        endif;

        echo wp_json_encode($retval);
        wp_die();
    }

    public static function ajax_paginate($records,$data,$display=10)
    {
        $current = $data['page'];
       
        $prev_next = absint($display/2);

        $pages = ceil($records->max_num_pages);
        if($pages<=1) return;

        if($pages<=$display){
            $high = $pages;
            $low = 1;
        }
        else{
           
            //HIGH
            if(($current+$prev_next) <= $pages){
                $high = $current+$prev_next;
            }
            else{
                $high = $pages;
            }
            //LOW
            if(($current-$prev_next) >= 1){
                $low = $current-$prev_next;
            }
            else{
                $low = 1;
            }
            if($current<=$prev_next){
                $high=$display;
                $low = 1;
            }
        }

       ob_start();?>
      <nav aria-label="Pagination">
        <ul class="pagination text-center">
        <?php   
                $count = $low;
                if($low>$prev_next):?>
                       <li><a data-page="1"
                                class="pagination-action edge" href="#" aria-label="First post "> << </a></li>

                <?php
                endif;
                while($count<=$high):
                    if($count==$current):?>
                       <li class="current"><span class="show-for-sr">You're on page</span><?=$count;?></li>
                    <?php else:?>
                       <li><a data-page="<?=$count;?>"
                                class="pagination-action" href="#" aria-label="Page <?=$count;?>"> <?=$count;?> </a></li>
                    <?php endif;
                    $count++;
                endwhile;
                   if($high<$pages):?>
                       <li><a data-page="<?=$pages;?>"
                                class="pagination-action edge" href="#" aria-label="Last post "> >> </a></li>

                <?php
                endif;?>
           </ul></nav>
        <?php 
          return ob_get_clean();
        


    }
}
