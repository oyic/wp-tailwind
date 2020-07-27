<?php
namespace Emma;

class Bootstrap
{
    public function __construct()
    {
        new  \Emma\Migration;// new \Emma\SqeOptions; // for brand new sites only 
        \Emma\Scripts::load();
        
        /** Load a new Sub Option page note: array of array  */
        AcfInit::$acf_options_new_sub_page = ['default'=>['menu_title'=>'Defaults','page_title'=>'Default Settings'] ] ;
        
        // AcfInit::$menu_title = ['menu_title'=>'Options'];
        // AcfInit::$page_title = ['menu_title'=>'Options'];

        
        \Emma\AcfInit::load();

        \Emma\Actions::load();
        \Emma\AdminPosts::load();
        \Emma\Ajax::load();
        new \Emma\ProtocolRelativeThemeAssets;
    }
}
