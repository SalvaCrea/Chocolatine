<?php
/**
 * Class sp_core
 */

namespace sp_framework;
use Medoo\Medoo;

class sp_core
{
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
			var $config;
			/**
			 * The url current, a fusion beetwen slug, current_module and $component
			 * @var string
			 */
			var $current_url;
			/**
			 * The slug is very pratice
			 * @var string
			 */
			var $slug = 'salva_powa';
			/**
			 * Contain the class module sp_controller for manage url
			 * @var object class
			 */
			var $controller;
			/**
			 * Contain the class module sp_ajax for resquest ajax
			 * @var object class
			 */
			var $ajax;
			/**
			 * Contain the class module sp_ressources for add ressource
			 * @var object class
			 */
			var $ressources;
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
			* The default is false, if i true than is dev mode
			* @var boolean
			 */
			var $is_dev = false;
			/**
			 * [$manager contain the managers]
			 * @var [stdclass]
			 */
			var $manager;
			/**
			 * __construct first action
			 */
			function __construct()
			{

				$this->path_folder = dirname( dirname(__FILE__) );
				$this->url_folder = '/wp-content/plugins/' . sp_get_current_name_folder( $this->path_folder );

				if ( is_admin() )
						add_action('admin_menu', array( $this, 'wp_admin_action' ));

			}
			/**
			 * This function load all modules
			 */
			public function init()
			{

				add_action('wp', function() {
					sp_controller::start();
				});
				
				$this->manager = new \stdClass();

				$this->ressources = new sp_ressources();

				$this->init_medoo();

				$this->manager->form = new sp_manager_form();

				$this->manager->view = new sp_manager_view();

				$this->manager->ajax = new sp_manager_ajax();

				$this->manager->model = new sp_manager_model();

				$this->manager->module = new sp_module_manager();

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
			/**
			 * Create view for the wp_admin
			 */
			public function create_back_view()
			{

					 sp_create_loader_js();
					 $view = $this->manager->module->get_module( 'sp_home' );
					 $view->view_back_sp();

			}


}
