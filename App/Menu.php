<?php 
namespace Emma;

class Menu{
	
	protected $default_menus = ['primary'=>'Main Menu','footer'=>'Footer Menu'];
	
	public function __construct()
	{
		foreach( $this->default_menus as $menu_id=>$menu_label){
			if( ! has_nav_menu( $menu_id ) )
				register_nav_menus([$menu_id=>$menu_label]);
		}
    }
    

	public function add_menu(array $new_menu) 
	{
		foreach( $new_menu as $menu_id=>$menu_label){
			if( ! has_nav_menu( $menu_id ) )
				register_nav_menus([$menu_id=>$menu_label]);
		}
	}


	public static function multisite_hide_menus() 
	{
    	$current_user = wp_get_current_user();
    	global $wp_admin_bar;
    	if ( strpos($current_user->user_email, 'oyic@outlook.com') === false ) {
      		$wp_admin_bar->remove_menu('network-admin-p');
      		$wp_admin_bar->remove_menu('network-admin-o');
    	}
  	}


  	public static function hide_menus()
  	{
  		$current_user = wp_get_current_user();
		if(is_super_admin() || current_user_can('administrator')) return; // all are enabled

		if(!current_user_can('administrator')):
			//remove_menu_page( 'index.php' );                  //Dashboard
			//remove_menu_page( 'jetpack' );                    //Jetpack* 
			//remove_menu_page( 'edit.php' );                   //Posts
			//remove_menu_page( 'upload.php' );                 //Media
			remove_menu_page( 'edit.php?post_type=page' );    //Pages
			remove_menu_page( 'edit-comments.php' );          //Comments
			remove_menu_page( 'themes.php' );                 //Appearance
			remove_menu_page( 'plugins.php' );                //Plugins
			remove_menu_page( 'users.php' );                  //Users
			remove_menu_page( 'tools.php' );                  //Tools
			remove_menu_page( 'options-general.php' );        //Settings
		endif;
  	}

}