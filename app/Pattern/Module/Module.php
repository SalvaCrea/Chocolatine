<?php

namespace sp_framework\Pattern\Module;

<<<<<<< HEAD
class Module extends Element
{

=======
class Module
{
	/**
	 * the name of the module
	 * @var string
	 */
    var $name;
>>>>>>> master
	/**
	 * The font awesome icon
	 * @var string
	 */
	var $icon;
	/**
<<<<<<< HEAD
=======
	 * The name un the menu
	 * @var string
	 */
	var $menu_name;
	/**
>>>>>>> master
	 * for the good rangement
	 * @var string
	 */
	var $categorie;
	/**
<<<<<<< HEAD
=======
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
>>>>>>> master
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
<<<<<<< HEAD
	/**
	 *  this is the root folder
	 * @var string
	 */
	var $path_folder;
	/**
	 * this a web url
	 * @var string
	 */
	var $url_folder;
=======
>>>>>>> master

	function __get( $name )
	{

		if ( $name == 'core' )
			 return \sp_framework\get_core();

		if ( $name == 'db' )
<<<<<<< HEAD
	 			return $this->find_core()->db;
=======
	 			return \sp_framework\get_service( 'database' );
>>>>>>> master

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
<<<<<<< HEAD
	 * The main view for administration
	 * @return boolean or string, if definy return a string
	 */
	public function view_back()
	{
			return false;
	}
	/**
=======
>>>>>>> master
	* Function use only component
	* @return boolean return false, only component return the father
	*/
 function get_father() { return false; }

<<<<<<< HEAD
=======

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

>>>>>>> master
}
