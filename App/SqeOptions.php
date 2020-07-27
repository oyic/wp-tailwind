<?php 
namespace Emma;

class SqeOptions{
   
    public function __construct()
    {
      
        if($this->is_initial()){

         
             $this->load_settings();
        }
    }
    public function is_initial()
    {
        
        return !file_exists( get_template_directory().'/_installed' );
        
    }
    public function load_settings()
    {
        wp_cache_delete ( 'alloptions', 'options' );
        //General
        update_option( 'blogname', 'Website Name',true );
        update_option( 'blogdescription', 'by Square Eye',true );
        update_option( 'admin_email', 'contact@Emma.com',true );
        update_option( 'WPLANG', 'en_GB',true );
        update_option( 'date_format', 'd M Y',true );
        update_option( 'timezone_string', 'Europe/London',true );
        //Reading
        update_option( 'blog_public', 0,true );
        update_option( 'rss_use_excerpt', 1,true );
        //Discussion
        update_option( 'default_comment_status', "closed",true );
        //Permalinks
        update_option( 'permalink_structure', "//%postname%//",true );
        
        //Media
         // Thumbnail
         update_option('thumbnail_size_w', 250);
         update_option('thumbnail_size_h', 250);
         update_option('thumbnail_crop', 1);
 
         // Medium
         update_option('medium_size_w', 512);
         update_option('medium_size_h', 512);
         update_option('medium_crop', 0);
 
         // Medium large
         update_option('medium_large_size_w', 960);
         update_option('medium_large_size_h', 960);
         update_option('medium_large_crop', 0);
 
         // Large
         update_option('large_size_w', 2048);
         update_option('large_size_h', 2048);
         update_option('large_crop', 0);

         $fh = fopen(get_template_directory().'/_installed', "w");
         if($fh==false) die("unable to create file");
         fclose ($fh);
    }
}