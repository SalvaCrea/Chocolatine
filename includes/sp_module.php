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
	var $module_action = array();
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
	 * This function is a fake constructor, in a php automatic father constructor automatically is not exist
	 * @return boolean
	 */

	function __get( $name )
	{

		if ( $name == 'slug' )
			 return sp_clean_string( $this->name );

		if ( $name == 'core' )
			 return $this->find_core();

		if ( $name == 'db' )
	 			return $this->find_core()->db;

		if ( $name == 'current_module' ){
				return $this->find_core()->controller->current_module;
		}
		/**
		 * This array for the current action
		 * @var array
		 */
		if ( $name == 'current_module_action' ){
				return $this->find_core()->controller->current_module_action;
		}


	}
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

		$loader = new \Twig_Loader_Filesystem( $this->get_uri() . '/template'); // Dossier contenant les templates

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
	/**
	 * This function return the sp_core
	 * @return object The class sp_core
	 */
	public function find_core()
	{
		global $sp_core;
		return $sp_core;
	}
	/**
	 * This function add a submodule for module
	 * @param [array] The arguments for add a submenu
	 */
	public function add_module_action( $args )
	{

			$args_default = array(
				'icon' => '',
				'name' => '',
				'slug' => '',
				'url' => '',
				'call_back' => '',
				'show_in_menu' => true
			);

			// add _ first elem home
			if ( empty( $this->module_action ) ) :

					$first_elem = $args_default;
					$first_elem['url'] = $this->core->controller->url;
					$first_elem['url'] .= "&module={$this->slug}";
					$first_elem['name'] = 'Home';
					$first_elem['slug'] = 'home';
					$this->module_action []= $first_elem;

			endif;

			$args = array_merge( $args_default, $args);

			if ( empty( $args['slug'] ) )
					$args['slug'] = sp_clean_string( $args['name'] );

			if ( empty( $args['url'] ) ):

				$args['url'] = $this->core->controller->url;
				$args['url'] .= "&module={$this->slug}";
				$args['url'] .= "&module_action={$args['slug']}";

			endif;

			$this->module_action []= $args;

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
					'action_module' => ''
			);

			$args = array_merge( $args_default, $args);

			$args['module'] = $this->slug;

			$this->core
						->ajax
						->add_ajax_listen( $args );

			return true;

	}
	/**
	 * This function add js in the personnal folder of module contain in the folder js
	 * @param string $name the name of the js
	 */
	public function add_module_js( $name )
	{
			wp_enqueue_script( $name,
				$this->get_url() . '/js/' . $name
			);
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
	public function data_schema()
	{
		return false;
	}
	public function data_form()
	{
		return false;
	}
	public function  get_name_form()
	{
			return $this->current_module->slug . '_' . $this->current_module_action['slug'] . '_form';
	}
	public function get_model()
	{
			$model = get_option(  $name );

			if (  $model != false )
					return  json_decode( $model, 1);

			return false;
	}
	function generate_form()
	{
		$form =  new \sp_form();

		$name = $this->get_name_form();

		$args = array(
			'name' => $name
		);

		if ( $this->data_schema() != false )
		{
				$args['schema'] = $this->data_schema();
				$args['schema']['title'] = $name;
		}

		if ( $this->data_form() != false )
				$args['form'] = $this->data_form();

		$model = get_option(  $name );

		if (  $model != false )
				$args['model'] = json_decode( $model, 1);

		$form = $form->create_form( $args );

		return $form;
	}
}
