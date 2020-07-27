<?php
namespace Emma;

class SqeThemeFunctions
{

    /**
     * Include a template parts; modified version of WP get_template_parts
     * @param  string  $path        file-path
     * @param  array   $vars        variables to be used
     * @param  boolean $return_vars return as a variable or included part of template
     * @return mix               eithe as a variable or an included part of a template
     */
    public static function get_template_parts_with_vars($path, $vars = [], $return_vars = false)
    {
        extract($vars);
        $template = locate_template("$path.php");
        if ($template === '') {
            wp_die("Template not found: $template");
        }
      

        if ($return_vars) {
            // Include and return the template
            ob_start();
            include $template;
            return ob_get_clean();
        } else {
            include $template;
        }
    }

    /**
     * return PODS related child posts id's
     * @param  str $cpt           the custom post type or post
     * @param  mix $val           the current value or id
     * @param  str $related_field the related field name
     * @return array              array of ids;
     */
    public static function get_related_fields($cpt, $val, $related_field, $limit = -1, $orderby = 'post_date', $order = 'DESC')
    {
        $return_values = array();
        $pod = pods($cpt, $val);
        $related_fields = $pod->field($related_field) ?: [];

        return array_map(function ($related_field) {
            return $related_field['ID'];
        }, $related_fields);
    }

    /**
     * Format mobile or phone number
     * @param  [string] $num unformatted phone number
     * @return [string]      formatted phone number
     */
    public static function phone_link($number, $display = true)
    {

        $num = str_replace(['(', ')'], '', $number);
        $num = str_replace(' ', '', $num);

        if (!$display) {
            return sprintf('<a href="tel:%1$s" class="tel-number">%2$s</a>', $num, $number);
        }

        //else
        printf('<a href="tel:%1$s" class="tel-number">%2$s</a>', $num, $number);
    }

    /**
     * create an anchor link from a raw link string
     * @param   string $link       url link
     * @param   boolean $new_window flag if new window when click
     * @param   string  $title      Overrides the link literal string
     * @param   boolean $display   display flag; echo or return;
     * @return  string             echoes out or return; depending on $display value;
     */
    public static function anchor_link($link, $title = '', $new_window = true, $display = true)
    {
        if (!$display) {
            return sprintf('<a href="%1$s" class="link" target="%3$s" > %2$s</a>', $link, $title ?: $link, $new_window ? '_blank' : ' ');
        }

        //else
        printf('<a href="%1$s" class="link" target="%3$s" > %2$s</a>', $link, $title ?: $link, $new_window ? '_blank' : ' ');
    }
    /**
     * create an email link or display it
     * @param   string $link       url link
     * @param   string  $title      Overrides the link literal string
     * @param   boolean $display   display flag; echo or return;
     * @return  string             echoes out or return; depending on $display value;
     */
    public static function email_link($link, $title = '', $display = true)
    {

        if (!$display) {
            return sprintf('<a href="mailto:%1$s">%2$s</a>', $link, $title ?: $link);
        }

        printf('<a href="mailto:%1$s">%2$s</a>', $link, $title ?: $link);
    }
    /**
     * create an anchor image link or display
     * @param  [type]  $link       [description]
     * @param  [type]  $image      [description]
     * @param  boolean $new_window [description]
     * @param  boolean $display    [description]
     * @return [type]              [description]
     */
    public static function imageLink($link, $image, $new_window = false, $display = true)
    {

        $image_url = sprintf('<img class="image-link" src="%1$s" alt="%2$s" >', $image, 'Image Link');
        $new_link = sprintf('<a href="%1$s" class="link" target="%3$s" > %2$s</a>', $link, $image_url, $new_window ? '_blank' : ' ');
        if (!$display) {
            return $new_link;
        }

        echo $new_link;
    }

    /**
     *  get the Title with option for link
     * @param  int $id  id to fetch
     * @param  boolean $link option for link
     * @return str titles with of without link
     */
    public static function get_title($id, $link = true, $display = true)
    {
        if ($link):
            if ($display):
                printf('<a href="%1$s" class="%2$s-title-link">%3$s</a>', get_permalink($id), get_post_type($id), get_the_title($id));
            else:
                return sprintf('<a href="%1$s" class="%2$s-title-link">%3$s</a>', get_permalink($id), get_post_type($id), get_the_title($id));
            endif;
        else:
            if ($display):
                echo get_the_title($id);
            else:
                return get_the_title($id);
            endif;
        endif;

    }

    /**
     * Checke wather current user is in the passed arrat params
     * @param  array  $roles array of user role ie. administrator,editor ... etc
     * @return boolean        [description]
     */
    public static function check_current_user_roles($roles = [])
    {
        $current_user = wp_get_current_user();
        $current_user_roles = (array) $current_user->roles;
        foreach ($roles as $role) {
            if (in_array($role, $current_user_roles)) {
                return true;
            }
        }
        return false;
    }
    public static function excerpt($limit)
    {
        $excerpt = explode(' ', get_the_excerpt(), $limit);

        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt) . '...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }

        $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

        return $excerpt;
        
    }

    public static function content($limit)
    {
        $content = explode(' ', get_the_content(), $limit);

        if (count($content) >= $limit) {
            array_pop($content);
            $content = implode(" ", $content) . '...';
        } else {
            $content = implode(" ", $content);
        }

        $content = preg_replace('/\[.+\]/', '', $content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        return $content;
        
    }

    public static function text($str, $limit = 15)
    {
        $content = explode(' ', $str, $limit);

        if (count($content) >= $limit) {
            array_pop($content);
            $content = implode(" ", $content) . '...';
        } else {
            $content = implode(" ", $content);
        }

        $content = preg_replace('/\[.+\]/', '', $content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        return $content;
        
    }
    /**
     * This grabs records from the Event Manager
     *
     * @param integer $return = number or events to return // default 12
     * @return ARRAY of formatted events
     */
    public static function get_events($return = 12)
    {
        $revtal = [];
        if (!class_exists('EM_Events')) {
            return "Enable Events Manager Pro";
        }

        $events = \EM_Events::get(['scope' => 'future', 'limit' => $return]);
    
        foreach ($events as $event):
            $date = self::get_em_date($event);
            $location = self::get_em_location($event->location_id);
            $retval[] = ['name' => $event->event_name,
                'content' => $event->post_content,
                'url' => $event->guid,
                'location' => $location,
                'dates' => $date];
        endforeach;
        
        return $retval;

    }
    public static function get_em_location($event_id)
    {
        $retval = [];
        $locations = \EM_Locations::get($event_id);
        if ($locations):
            foreach ($locations as $loc):
                $retval = ['name' => $loc->location_name,
                    'address' => $loc->location_address,
                    'town' => $loc->location_town,
                    'state' => $loc->location_state,
                    'post_code' => $loc->location_postcode];
            endforeach;
        endif;
        return $retval;
    }
    public static function get_em_date($event)
    {

        $allday = $event->event_all_day;
        $start = strtotime($event->start_date);
        $end = strtotime($event->end_date);
        $startTime = strtotime($event->start_time);
        $endTime = strtotime($event->end_time);

        if ($start != $end) {

            if (date('F', $start) == date('F', $end)):
                $retval['date'] = date('d', $start) . ' - ' . date('d', $end) . ' ' . date('M', $start) . ', ' . date('Y', $end);
            else:
                $retval['date'] = date('d', $start) . ' ' . date('M', $start) . ' - ' . date('d', $end) . ' ' . date('M', $end) . ', ' . date('Y', $end);
            endif;
            if (!$allday) {
                $retval['time'] = date("h:i a", $startTime) . ' - ' . date('h:i a', $endTime);
            }
        }

        return $retval;

    }

    public static function paginate($pages = '', $range = 10)
    {
        $showitems = ($range * 2) + 1;

        global $paged;

        if ($pages == '') {
            global $wp_query;

            $pages = $wp_query->max_num_pages;

            if (!$pages) {
                $pages = 1;
            }
        }

        if (1 != $pages) {
            echo '<nav aria-label="Pagination">
						<ul class="pagination text-center">';
            //echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
            if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
                //echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
            }
            if ($paged > 1 && $showitems < $pages) {
                echo "<li class='pagination-previous'><a href='" . get_pagenum_link($paged - 1) . "'></a></li>";
            }
            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                    echo ($paged == $i) ? "<li><span class='current-page'>" . $i . "</span></li>" : "<li><a aria-label='Page $i' href='" . get_pagenum_link($i) . "' class='inactive-page'>" . $i . "</a></li>";
                }
            }
            if ($paged < $pages && $showitems < $pages) {
                echo "<li class='pagination-next'><a href='" . get_pagenum_link($paged + 1) . "'></a></li>";
            }
            if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
                //echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
            }
            echo "</ul></nav>";
        }
    }
    public function display_vcard($id = null)
    {

        //vars
        $phone = '';
        $mobile = '';
        $email = '';
        $fax = '';
        $organisation = '';
        $dx = '';
        $address1 = '';
        $address2 = '';
        $city = '';
        $postcode = '';
        $country = '';
        $thumbnail_url = get_the_post_thumbnail_url('person');

        $keys = array('organisation', 'address1', 'address2', 'city', 'postcode', 'country', 'phone', 'fax', 'email', 'dx');
        foreach ($keys as $key) {
            ${$key} = '';
            ${$key} = get_field($key, 'option');
        }

        if (!$id) {
            $id = get_the_id();
        }
        $type = get_post_type($id);
        $slug = basename(get_the_permalink($id));

        $fullname = get_the_title($id);
        $jobtitle = get_post_meta($id, 'job_title', true);
        if ($type == 'barrister') {
            $jobtitle = 'Barrister';
        }
        $names = explode(' ', trim($fullname));
        $firstname = $names[0];
        $surname = get_post_meta($id, 'surname', true);
        $silkyear = get_post_meta($id, 'silk_year', true);
        if ($silkyear > 0) {
            $surname .= ' QC';
        }

        $phone = get_post_meta($id, 'phone', true);
        if (!$phone) {
            $phone = '+' . get_field('phone', 'option');
        }

        $personal_email = get_post_meta($id, 'email', true);
        if (!$personal_email) {
            $personal_email = $email;
        }
        $mobile = get_field('mobile');

        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'thumbnail');
        $thumburl = $thumb['0'];
        $thumbarr = parse_url($thumburl);
        $thumbpath = $_SERVER['DOCUMENT_ROOT'] . $thumbarr['path'];

        $output = array();
        $output[] = "BEGIN:VCARD";
        $output[] = "VERSION:4.0";
        $output[] = "FN:" . $fullname;
        $output[] = "N:" . $surname . ";" . $firstname . ";;;";
        $output[] = "ORG:" . $organisation;
        if ($jobtitle) {
            $output[] = "TITLE:" . $jobtitle;
        }
        $output[] = "ADR;INTL;PARCEL;WORK:;" . $organisation . ";" . $address1 . ";" . $address2 . ";" . $city . ";" . $postcode . ";" . $country . ";";

        $output[] = "URL:https://" . $_SERVER['SERVER_NAME'] . "/" . $type . "/" . $slug;
        if ($thumburl) {
            $output[] = "PHOTO;TYPE=JPEG;VALUE=URI:" . $thumburl;
        }
        $output[] = "EMAIL;type=INTERNET;type=pref:" . $personal_email;
        $output[] = "TEL;type=WORK;type=VOICE;type=pref:" . $phone;
        $output[] = "TEL;type=CELL;type=VOICE;type=pref:" . $mobile;

        if ($thumbnail_url) {
            $output[] = "PHOTO;VALUE=uri:" . $thumbnail_url;
        }

        if ($dx) {
            $output[] = "item1.TEL:" . $dx;
            $output[] = "item1.X-ABLabel:DX";
        }

        $output[] = "END:VCARD";

        $output = implode("\n", $output);

        // Now create the file

        $last_mod = get_the_modified_date($id);
        $vcard_path = WP_CONTENT_DIR . '/vcards/';
        $vcard_fn = $vcard_path . $slug . '.vcf';
        $vcard_url = WP_CONTENT_URL . '/vcards/' . $slug . '.vcf';
       
        if (!file_exists($vcard_fn) || filemtime($vcard_fn) > $last_mod) {
            file_put_contents($vcard_fn, $output);
        }

        // Now print the link to the file
        
        echo $vcard_url;

    }
    public static function get_area_submenu($category=null,$limit=-1)
    {
        $retval = false;
        $args = array(
            'post_type'              => array( 'area' ),
            'nopaging'               => true,
            'posts_per_page'         => $limit,
            'order'                  => 'ASC',
            'orderby'                => 'title',
        );
        
        if ($category) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'area_category',
                    'field'    => 'slug',
                    'terms'    => $category,
                ));
        }
        // The Query
        $areas = new WP_Query( $args );
        // The Loop
        if ( $areas->have_posts() ) :
            while ( $areas->have_posts() ) :
                $areas->the_post();
                $retval[] = '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
            endwhile;
        wp_reset_postdata();

        endif;
        return $retval;
    }
}
