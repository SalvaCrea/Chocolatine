<?php
/**
 * Class sp_core
 */

namespace salva_powa;
use \Medoo;

class sp_core
{
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
			 * The value of configuration for sp powa
			 * @var array
			 */
			var $config;
			/**
			 * The current module actif on the view
			 * @var object class
			 */
			var $current_module;
			/**
			 * The current sub module actif on the view
			 * @var string
			 */
			var $module_action;
			/**
			 * The url current, a fusion beetwen slug, current_module and $module_action
			 * @var string
			 */
			var $current_url;
			/**
			 * The slug is very pratice
			 * @var string
			 */
			var $slug = 'salva_powa';
			/**
			 * The url of extension in the wp-admin
			 * @var string
			 */
			var $url;
			/**
			 * Contain the class module manager and list all modules
			 * @var object class
			 */
			var $modules;
			/**
			 * The medoo Class for manipule data base
			 * @var object class
			 */
			var $db;
			/**
			 * __construct first action
			 */
			function __construct()
			{

				$this->init_class();

				$this->uri_folder = dirname( dirname(__FILE__) );
				$this->url_folder = plugins_url( 'salva-powa-wordpress' );
				$this->url =  "/wp-admin/admin.php?page={$this->slug}";

				$this->config = json_decode ( get_option( $this->slug ), 1 );

				add_action('admin_menu', array( $this, 'wp_admin_do' ));

			}
			/**
			 * This function load all modules
			 */
			public function init_class()
			{

				$this->init_medoo();

				$this->ajax = new sp_ajax();

				if ( $_GET['page'] == $this->slug )
						$this->ajax->add_ressource();

				$this->controller =  new sp_controller();

				$this->modules = new sp_module_manager();
				$this->modules->search_modules();

			}
			/**
			 * Instance the class meedoo
			 */
			function init_medoo()
			{
					global $wpdb;

					// create un object medoo for manipule data base
					$this->db = new Medoo(
							array(
								'database_type' => 'mysql',
								'database_name' => $wpdb->dbname,
								'server' => $wpdb->dbhost,
								'username' => $wpdb->dbuser,
								'password' => $wpdb->dbpassword,
								'charset' => $wpdb->charset
						)
				);

			}

			/**
			 * Find the current module by the url
			 * @return [string] return the current module
			 */
			public function get_current_module()
			{

				$current_module_action = false;

				if ( isset( $_GET['module'] ) && !empty( $_GET['module'] ) )
				{
							$this->current_module = $this->get_module( $_GET['module'] );
				}
				else
				{
						 $this->current_module = $this->get_module( 'home' );
				}

				if ( isset( $_GET['module_action'] ) && !empty( $_GET['module_action'] ) ) {

						$this->module_action = $_GET['module_action'];
						$current_module_action = array_find( $this->current_module->module_action, 'slug', $this->module_action );

						if ( $current_module_action != false ) {
								$this->current_module->current_module_action = $this->current_module->module_action[$current_module_action];
						}

				}


			}
			/**
			 * This function return un module by the name
			 * @param  [string] $module the name of the module
			 * @return [object Class]   Return the module
			 */
			public function get_module( $module )
			{
					return $this->
									modules->
									list_modules[ $module ];
			}
			/**
			 * Contains the tasks to be executed in the wordpress administration part
			 */
			public function wp_admin_do()
			{
					// load the ressources int the wp -admin
					if ( $_GET['page'] == $this->slug )
							 $this->sp_ressource();

					 // find the current module
 					 $this->get_current_module();

					 // find current url
					 $this->get_current_url();

					 // add a menu compatible Wordpress
					 add_menu_page(
						 'SP Framework',
						 'SP Framework',
						 'administrator',
						 $this->slug,
						 array( $this,'create_back_view' ),
						 'dashicons-hammer',
						 10
					 );

			}
			/**
			 * Create view for the wp_admin
			 */
			public function create_back_view()
			{

					 $view = new \sp_home();
					 $view->view_back_sp();

			}
			/**
			 * General a url for the wp-admin
			 * @return string
			 */
			public function get_current_url()
			{

					$url = $this->url;

					if ( !empty( $this->current_module->slug ))
						$url .= "&module={$this->current_module->slug}";

					if ( !empty( $this->module_action ) )
						$url .= "&module_action={$this->module_action}";

					$this->current_url = $url;

					return $url;

			}
			/**
			 * List of ressource necessary for the good fonctionnement
			 */
			public function sp_ressource()
			{


			}
}
