<?php
/**
 * Class sp_core
 */

namespace sp_framework;

class sp_core
{
			/**
			 * __construct first action
			 */
			public static $sp_core;
			/**
			 *  Name of the theme
			 * @var string
			 */
			public $theme;
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
			/**
			 * The value of configuration for Sp Framework
			 * @var array
			 */
			var $configuration;
			/**
			* The default is false, if i true than is dev mode
			* @var boolean
			 */
			var $is_dev = false;
			/**
			 * [$manager contain the managers]
			 * @var [stdclass]
			 */
			var $manager;

			function __construct()
			{

				$this->path_folder = dirname( dirname(__FILE__) );
				$this->url_folder = '/wp-content/plugins/' . sp_get_current_name_folder( $this->path_folder );

				if ( is_admin() )
						add_action('admin_menu', array( $this, 'wp_admin_action' ));

			}
			public function get_configuration(){
					$this->configuration = require "./configuration.php";
			}
			public static function get_sp_core(){

					if ( !empty( self::$sp_core )) { $sp_core->init(); }

					return self::$sp_core;
			}
			/**
			 * This function load all modules
			 */
			public function init()
			{

				self::$sp_core = new sp_core();

				add_action('wp', function() {
					sp_controller::start();
				});

				$this->get_configuration();

				$this->manager = new \stdClass();

				$this->ressources = new sp_ressources();

				$this->manager->form = new sp_manager_form();

				$this->manager->view = new sp_manager_view();

				$this->manager->ajax = new sp_manager_ajax();

				$this->manager->model = new sp_manager_model();

				$this->manager->services = new sp_manager_service();

				$this->manager->module = new sp_manager_module();

				$this->manager->ajax->add_ressource();

				$this->manager->module->search_modules();

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
			 * Contains the tasks to be executed in the wordpress administration part
			 */
			public function wp_admin_action()
			{
					// load the ressources int the wp -admin
					if ( is_sp_admin() )
							 $this->ressources->main_ressources();


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
}
