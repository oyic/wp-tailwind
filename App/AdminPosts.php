<?php
namespace Emma;

class AdminPosts{
    
    private static $admin_posts = ['print_pdf_file'=>[\Emma\Sqepdf::class,'print_pdf_file']]; // "actionname" => "method_handler"

    public static function load()
    {
        foreach (self::$admin_posts as $action=>$handler) {
            add_action("admin_post_".$action, $handler);
        }
    }
}
