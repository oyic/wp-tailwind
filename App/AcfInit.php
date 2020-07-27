<?php
namespace Emma;

class AcfInit
{

    public static $page_title = ['page_title'=>'Top 5 Site Custom Settings'];

    public static $menu_title = ['menu_title'=> 'Top5 Settings'];

    private static $acf_option_page_defaults = [
                        'menu_slug' =>'custom-theme-general-settings',
                        'capability'=> 'edit_posts',
                        'redirect'  => true,
                        'position' => 4.1,
                        ];
    
                        private static $sub_pages_default = ['header'=>['page_title'=>'Header Settings','menu_title'=>'Header'],
                                         'footer'=>['page_title'=>'Footer Settings','menu_title'=>'Footer']];
    
                                         public static $acf_options_new_sub_page=[];
    

    public static function load()
    {
        if (function_exists('acf_add_options_page')):
            $acf_page = array_merge(self::$page_title, self::$menu_title, self::$acf_option_page_defaults);
            acf_add_options_page(
                    $acf_page
                );
            
        self::acf_options_sub_page();
        endif;
    }


    public static function acf_options_sub_page()
    {
        if (function_exists('acf_add_options_sub_page')):
                $all_sub_pages = array_merge(self::$sub_pages_default, self::$acf_options_new_sub_page);

        foreach ($all_sub_pages as $key=>$pages) {
            $sub_page = array_merge($pages, ['parent_slug'=>self::$acf_option_page_defaults['menu_slug']]);
            acf_add_options_sub_page($sub_page);
        };
        endif;
    }


    public static function acf_load_fields()
    {
        if (function_exists('acf_get_field_groups')):
            // vars
            $groups = acf_get_field_groups();
        $sync   = array();
        // bail early if no field groups
        if (empty($groups)) {
            return;
        }
        // find JSON field groups which have not yet been imported
        foreach ($groups as $group) {
            // vars
            $local      = acf_maybe_get($group, 'local', false);
            $modified   = acf_maybe_get($group, 'modified', 0);
            $private    = acf_maybe_get($group, 'private', false);
            // ignore DB / PHP / private field groups
            if ($local !== 'json' || $private) {

                    // do nothing
            } elseif (! $group[ 'ID' ]) {
                $sync[ $group[ 'key' ] ] = $group;
            } elseif ($modified && $modified > get_post_modified_time('U', true, $group[ 'ID' ], true)) {
                $sync[ $group[ 'key' ] ]  = $group;
            }
        }
        // bail if no sync needed
        if (empty($sync)) {
            return;
        }
        if (! empty($sync)) { //if( ! empty( $keys ) ) {

            // vars
            $new_ids = array();

            foreach ($sync as $key => $v) { //foreach( $keys as $key ) {
                // append fields
                if (acf_have_local_fields($key)) {
                    $sync[ $key ][ 'fields' ] = acf_get_local_fields($key);
                }
                // import
                $field_group = acf_import_field_group($sync[ $key ]);
            }
        }
        endif;
    }
}
