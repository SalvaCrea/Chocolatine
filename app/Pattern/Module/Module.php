<?php

namespace sp_framework\Pattern\Module;

class Module
{
	/**
	 * the name of the module
	 * @var string
	 */
    var $name = __CLASS__;
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

		if ( $name == 'current_module' )
				return $this->find_core()->controller->current_module;

		if ( $name == 'father' )
				return $this->get_father();
		/**
		 * This array for the current action
		 * @var array
		 */
		if ( $name == 'current_component' )
				return $this->find_core()->controller->current_component;

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

	/**
	 * Use the framework twig like template motor
	 * @param  [string] $template_name the name of file html
	 * @param  [array] $array_info  the array content informations for the doc html
	 * @return [string]   return the file html with information of array
	 */
	public function twig_render( $template_name, $array_info = array() )
	{
    if ( !isset( $this->twig ) ){
			\Twig_Autoloader::register();

			$loader = new \Twig_Loader_Filesystem( $this->get_uri() . '/template'); // Dossier contenant les templates

	    $this->twig = new \Twig_Environment($loader, array(
	      'cache' => false
	    ));
		}
		return  $this->twig->render( $template_name, $array_info );
	}
	/**
	 * [add_form the method for add form for the module]
	 * @param [type] $args [description]
	 */
	public function add_form( $args )
	{
		if ( empty( $this->model ) ) {
					$this->form = new \stdClass();
		}

		$args_default = array(
				'name' => '',
				'model' => '',
				'type' => ''
		);

		$args = $this->the_add_filter( $args_default, $args);

		if ( !empty( $args['name'] ) ){

				$this->cpt->{$args['name']} = $this->the_recover(
					'form',
					$args['name']
				);

		}

	}
	public function add_model( $args )
	{

		if ( empty( $this->model ) ) {
					$this->model = new \stdClass();
		}

			$args_default = array(
					'name' => '',
					'slug' => '',
					'type' => ''
			);

			$args = $this->the_add_filter( $args_default, $args);

			if ( empty( $args['slug'] ) )
					$args['slug']  = sp_clean_string( $args['name'] );

			$this->model->{$args['slug']} = $this->the_recover(
				'model',
				$args['slug']
			);

			$this->core
					->manager
					->model
					->add_model( $args );

	}
	/**
	 * This function add a submodule for module
	 * @param [array] The arguments for add a submenu
	 */
	public function add_view( $args )
	{

		if ( empty( $this->view ) ) {
					$this->view = new \stdClass();
		}

		$args_default = array(
			'name' => '',
			'slug' => '',
			'description' => ''
		);

		$args = $this->the_add_filter( $args_default, $args);

		if ( empty( $args['slug'] ) )
				$args['slug']  = sp_clean_string( $args['name'] );

		if ( !empty( $args['slug'] ) ){

				$this->core
						->manager
						->view
						->add_view( $args );

				$this->view->{$args['slug']} = $this->the_recover(
					'view',
					$args['slug']
				);

		}

	}
	/**
	 * [add_component add a sub module ** deprecated ** ]
	 * @param [array] $args [contain the info for create a sub module]
	 */
	public function add_component( $args )
	{

			if ( empty( $this->cpt ) ) {
						$this->cpt = new \stdClass();
			}

			$args_default = array(
				'name' => '',
				'slug' => '',
				'description' => ''
			);

			$args = $this->the_add_filter( $args_default, $args);

			if ( !empty( $args['slug'] ) ){

					$this->cpt->{$args['slug']} = $this->the_recover(
						'component',
						$args['slug']
					);

			}

	}

	/**
	 * This function open route for the ajax
	 * @param array $args ann array than contain information for open route
	 */
	public function add_ajax( $args )
	{

			$args_default = 	array(
					'name' => '',
					'description' => ''
			);

			$args = $this->the_add_filter( $args_default, $args);

			 if ( !empty( $args['name'] ) ){

					 $this->core
		 					 ->manager
							 ->ajax
		 					 ->add_ajax_listen( $args );

					 $this->cpt->{$args['name']} = $this->the_recover(
						 'ajax',
						 $args['name']
					 );

			 }

	}
	/**
	 * [add_back_menu add a menu in the module sp admin]
	 * @param [array] $args [the argument for add menu]
	 */
	public function add_back_menu( $args )
	{
			$args_default = 	array(
					'name' => '',
					'name_menu' => '',
					'view' => ''
			);

			$args = $this->the_add_filter( $args_default, $args);
	}
	/**
	 * [the_add_filter use for the all request of add for the managers]
	 * @param [array] $args_default [arguments by default]
	 * @param [array] $args         [argument for add]
	 * @return [array] $args_filted [args filted]
	 */
	public function the_add_filter( $args_default, $args )
	{
			$args_filted = array_merge( $args_default , $args );
			$args_filted['module'] = $this->get_slug();
			return $args_filted;
	}
	/**
	 * [the_recover this function require the file and create the instance of the class]
	 * @return [type] [description]
	 */
	public function the_recover( $folder_name, $file_name )
	{

		require $this->get_uri() . '/' . $folder_name . '/' . $file_name . '.php';

		$name_class = "\\{$this->namespace}\\{$file_name}";

		$class = new $name_class();
		$class->parent_module = $this->get_slug();
		$class->slug = $file_name;

		return $class;

	}
	/**
	 * This function add js in the personnal folder of module contain in the folder js
	 * @param string $name the name of the js
	 */
	public function add_js( $module_url, $name = '', $data = array() )
	{

			if ( empty( $name ) ) {
				$name = $module_url;
			}

			// add the js in the list
			wp_enqueue_script( $name,
				$this->get_url() . '/js/' . $module_url
			);

			// write the data for the js
			if ( !empty( $data ) ) {
			wp_localize_script(
				$name,
				'data_' . $name,
				$data
				);
			}
	}
	/**
	 * This function add js in the personnal folder of module contain in the folder js
	 * @param string $name the name of the css
	 */
	public function add_css( $name )
	{
				wp_enqueue_style( $name,
					$this->get_url() . '/css/' . $name
				);
	}
	/**
	 * Convert variable php in variable js ** depracated **
	 * @param  string $key the key for array
	 * @param  array $args the array to convert
	 * @return boolean True is good action or false is not good
	 */
	public function convert_in_js( $key, $args )
	{
				if ( isset( $args ) ) {
						$this->core->ajax->convert_in_js[ $key ] = $args;
						return true;
				}
				else
				{
					 return false;
				}
	}

}
