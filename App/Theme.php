<?php 
namespace Emma;

class Theme{
    
    
    protected $theme;
    
    
	public function __construct()
	{
		$this->theme = wp_get_theme();
		define('THEME_VERSION', $this->theme->Version);
		new \Emma\Bootstrap; // boots up
		$menu = new Menu();
		// $menu->add_menu(['secondary'=>'Secondary Menu']);
    }
    
}