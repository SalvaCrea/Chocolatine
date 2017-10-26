<?php

namespace sp_framework\Pattern\Module;

class Module
{
	/**
	 * the name of the module
	 * @var string
	 */
    var $name;
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
	 * for the good rangement
	 * @var string
	 */
	var $categorie;
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
	 * This array is use for declarate the component for the v2
	 * @var object
	 */
	var $cpt;
	/**
	 * This array is use for declarate the model for the v2
	 * @var object
	 */
	var $model;
	/**
	 * This array is use for declarate the ajax action
	 * @var array
	 */
	var $ajax;
	/**
	 * This array contain the list of the view link module
	 * @var array
	 */
	var $views;

	function __get( $name )
	{

		if ( $name == 'core' )
			 return \sp_framework\get_core();

		if ( $name == 'db' )
	 			return \sp_framework\get_service( 'database' );

	}
	/**
	 * Function call then when call the function get_module in module manager
	 * @return mixed boolean false if not use;
	 */
	function getter()
	{
			return false;
	}
	/**
	 * The view loader
	 * @return boolean or mixed, return false if is empty
	 */
	public function after_factory()
	{
			return false;
	}
	/**
	* Function use only component
	* @return boolean return false, only component return the father
	*/
 function get_father() { return false; }


	}
	public function add_model( $args )
	{

	}
	/**
	 * This function add a submodule for module
	 * @param [array] The arguments for add a submenu
	 */
	public function add_view( $args )
	{

	}
	/**
	 * [add_component add a sub module ** deprecated ** ]
	 * @param [array] $args [contain the info for create a sub module]
	 */
	public function add_component( $args )
	{

	}

	/**
	 * This function open route for the ajax
	 * @param array $args ann array than contain information for open route
	 */
	public function add_ajax( $args )
	{

	}

}
