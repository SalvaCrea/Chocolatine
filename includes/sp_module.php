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
	 * The id name
	 * @var string
	 */
	 var $slug;
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
	 * This array is use for declarate the sub module
	 * @var array
	 */
	var $sub_module = array();
	/**
	 * This array is use for declarate the ajax action
	 * @var array
	 */
	var $ajax_action = array();
	/**
	 * This array contain the list of the view link module
	 * @var array
	 */
	var $views = array();
	/**
	 *  this is the root folder
	 * @var string
	 */
	var $uri_folder;
	/**
	 * this a web url
	 * @var string
	 */
	var $url_folder;
	/**
	 * The url in the admin
	 * @var string
	 */
	var $url;

	function __get( $name )
	{

		if ( $name == 'core' )
			 return $this->find_core();

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
		if ( $name == 'current_sub_module' )
				return $this->find_core()->controller->current_sub_module;

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
	public function loader_view()
	{
			return false;
	}
	/**
	 * The sub module loader
	 * @return boolean or mixed, return false if is empty
	 */
	public function loader_sub_module()
	{
			return false;
	}
	/**
	 * The ajax loader ajax action
	 * @return boolean or mixed, return false if is empty
	 */
	public function loader_ajax_action()
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
	* Function use only sub_module
	* @return boolean return false, only sub_module return the father
	*/
 function get_father() { return false; }
	/**
	 * Return the slug of the class
	 * @return string the id string of the class
	 */
	function get_slug()
	{
		/**
		 * Create slug for function
		 */
		if ( empty( $this->slug ) ) {

				if ( empty( $this->name )) {
					$this->slug = sp_clean_string( $folder_root['name'] );
				}
				else
				{
					$this->slug = sp_clean_string( $this->name );
				}
		}
		return $this->slug;

	}
	/**
	 * Function for get the web URL
	 * @return string web url
	 */
	function get_url()
	{

			if ( empty( $this->url_folder ) ) {

				$uri = $this->get_uri();

				$this->url_folder = substr(
					$uri,
					strpos( $uri, '/wp-content' ),
					strlen( $uri )
				);

			}

			return $this->url_folder;
	}
	/**
	 * Function return the root folder of the module
	 * @return String
	 */
	function get_uri()
	{
			if ( empty( $this->uri_folder ) ) {
				$this->uri_folder = $this->dir_file_class();
			}
			return $this->uri_folder;
	}
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
	 * Return le path of extend class
	 * @return [string] Return le path of extend class
	 */
	public function dir_file_class()
	{
		$a = new \ReflectionClass($this);
		return dirname( $a->getFileName() );
	}
	/**
	 * This function return the sp_core
	 * @return object The class sp_core
	 */
	public function find_core()
	{
		global $sp_core;	return $sp_core;
	}
	/**
	 * This function add a submodule for module
	 * @param [array] The arguments for add a submenu
	 */
	public function add_view( $args )
	{

		$args_default = array(
			'name' => '',
			'slug' => '',
			'url' => '',
			'call_back' => '',
			'show_in_menu' => true,
		);

		$args = array_merge( $args_default, $args);

		$this->views []= $args;
		$this->core->controller->views []= $args;

	}
	public function add_sub_module( $args )
	{

			$args_default = array(
				'name' => '',
				'slug' => '',
				'url' => '',
				'call_back' => '',
				'show_in_menu' => true,
				'sub_module' => '',
			);

			// add _ first elem home
			if ( empty( $this->sub_module ) ) :

					$first_elem = $args_default;
					$first_elem['url'] = $this->core->controller->url;
					$first_elem['url'] .= "&module={$this->get_slug()}";
					$first_elem['name'] = 'Home';
					$first_elem['slug'] = 'home';
					$this->sub_module []= $first_elem;

			endif;

			$args = array_merge( $args_default, $args);

			if ( empty( $args['slug'] ) )
					$args['slug'] = sp_clean_string( $args['name'] );

			if ( empty( $args['url'] ) ):

				$args['url'] = $this->core->controller->url;
				$args['url'] .= "&module={$this->get_slug()}";
				$args['url'] .= "&sub_module={$args['slug']}";

			endif;

			if ( !empty( $args['sub_module'] ) ):

					require $this->get_uri() . '/sub_module/' . $args['sub_module'] . '.php';

					$this->{$args['slug']} = new $args['sub_module']();
					$this->{$args['slug']}->parent_module = $this->get_slug();
					$this->{$args['slug']}->slug = $args['slug'];

			endif;

			$this->sub_module []= $args;
			$this->add_view( $args );

	}
	/**
	 * This function open route for the ajax
	 * @param array $args ann array than contain information for open route
	 */
	public function add_ajax_action( $args )
	{
			$args_default = 	array(
					'name' => '',
					'call_back' => '',
					'sub_module' => ''
			);

			$args = array_merge( $args_default, $args);

			$args['module'] = $this->get_slug();

			$this->ajax_action []= $args;

			$this->core
						->ajax
						->add_ajax_listen( $args );

			return true;
	}
	/**
	 * This function add js in the personnal folder of module contain in the folder js
	 * @param string $name the name of the js
	 */
	public function add_module_js( $module_url, $name = '', $data = array() )
	{

			if ( empty( $name ) ) {
				$name = $module_url;
			}

			wp_enqueue_script( $name,
				$this->get_url() . '/js/' . $module_url
			);

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
	public function add_module_css( $name )
	{
				wp_enqueue_style( $name,
					$this->get_url() . '/css/' . $name
				);
	}
	/**
	 * Convert variable php in variable js
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
