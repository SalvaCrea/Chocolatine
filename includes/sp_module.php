<?php

namespace salva_powa;

class sp_module
{
	/**
	 * the name of the module
	 * @var string
	 */
	var $name;
	/**
	 * the version of the module
	 * @var string
	 */
	var $version;
	/**
	 * the name of author
	 * @var string
	 */
	var $author;
	/**
	 * The font awesome icon
	 * @var string
	 */
	var $icon;
	/**
	 * The name un the menu
	 * @var string
	 */
	var $menu_name;
	/**
	 * the patch of the class
	 * @var string
	 */
	var $file_path;
	/**
	 * the position default in the list menu in the administration
	 * @var integer
	 */
	var $menu_position = 100;
	/**
	 * if show in the list menu
	 * @var boolean
	 */
	var $show_in_menu = false;

	/**
	 * This array is use for declarate the sub module
	 * @var array
	 */
	var $sub_module = array();

	function __construct()
	{
			$this->file_path = dirname(__FILE__);
	}
	function __get( $name )
	{

		if ( $name == 'slug' )
			 return sp_clean_string( $this->name );

		if ( $name == 'core' )
			 return $this->find_core();

	}
	/**
	 * Use the framework twig like template motor
	 * @param  [string] $template_name the name of file html
	 * @param  [array] $array_info  the array content informations for the doc html
	 * @return [string]   return the file html with information of array
	 */
	public function twig_render( $template_name, $array_info)
	{

    if ( !isset( $this->twig ) )
				$this->twig_constructor();

		return  $this->twig->render( $template_name, $array_info );

	}
	// construct the motor twig
	public function twig_constructor()
	{
		\Twig_Autoloader::register();

		$loader = new \Twig_Loader_Filesystem( $this->dir_file_class() . '/template'); // Dossier contenant les templates

    $this->twig = new \Twig_Environment($loader, array(
      'cache' => false
    ));

	}
	/**
	 * Return le path of extend class
	 * @return [string] Return le path of extend class
	 */
	public function dir_file_class()
	{
		$a = new \ReflectionClass($this);
		return dirname( $a->getFileName() );
	}
	public function find_core()
	{
		global $sp_core;
		return $sp_core;
	}
	/**
	 * This function add a submodule for module
	 * @param [array] The arguments for add a submenu
	 */
	public function add_sub_module( $args )
	{

			$args_default = array(
				'icon' => '',
				'name' => '',
				'slug' => ''
			);

			$args = array_merge( $args_default, $args);

			if ( empty( $args['slug'] ) )
					$args['slug'] = sp_clean_string( $args['name'] );

			$this->sub_module []= $args;

	}
}
