<?php

namespace sp_framework\Pattern\Module;

class Module extends Element
{

	/**
	 * The font awesome icon
	 * @var string
	 */
	var $icon;
	/**
	 * for the good rangement
	 * @var string
	 */
	var $categorie;
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

	function __get( $name )
	{

		if ( $name == 'core' )
			 return \sp_framework\get_core();

		if ( $name == 'db' )
	 			return $this->find_core()->db;

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
	 * The main view for administration
	 * @return boolean or string, if definy return a string
	 */
	public function view_back()
	{
			return false;
	}
	/**
	* Function use only component
	* @return boolean return false, only component return the father
	*/
 function get_father() { return false; }

}