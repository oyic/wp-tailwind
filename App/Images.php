<?php
namespace Emma;

class Images{
   
    public static function set_images()
    {
        // Thumbnail
        update_option('thumbnail_size_w', 320);
        update_option('thumbnail_size_h', 9999);
        update_option('thumbnail_crop', 0);

        // Medium
        update_option('medium_size_w', 640);
        update_option('medium_size_h', 9999);
        update_option('medium_crop', 0);

        // Medium large
        update_option('medium_large_size_w', 960);
        update_option('medium_large_size_h', 9999);
        update_option('medium_large_crop', 0);

        // Large
        update_option('large_size_w', 1280);
        update_option('large_size_h', 9999);
        update_option('large_crop', 0);
    }
}
