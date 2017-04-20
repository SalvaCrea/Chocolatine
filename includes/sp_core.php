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
			var  $uri_folder;
			/**
			 * this a web url
			 * @var string
			 */
			var  $url_folder;
			/**
			 * The value of configuration for sp powa
			 * @var array
			 */
			var $config;
			/**
			 * The url current, a fusion beetwen slug, current_module and $sub_module
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
			 * __construct first action
			 */
			function __construct()
			{

				$this->uri_folder = dirname( dirname(__FILE__) );
				$this->url_folder = plugins_url( 'salva-powa-wordpress' );

				$this->config = json_decode ( get_option( $this->slug ), 1 );

				if ( is_admin() )
						add_action('admin_menu', array( $this, 'wp_admin_action' ));

			}
			/**
			 * This function load all modules
			 */
			public function init()
			{

				$this->ressources = new sp_ressources();

				$this->init_medoo();

				$this->ajax = new sp_ajax();
				if ( is_sp_admin() )
					$this->ajax->add_ressource();
					
				$this->modules = new sp_module_manager();

				$this->controller =  new sp_controller();

				$this->modules->search_modules();

				$this->controller->init();



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
					 $view = $this->modules->get_module( 'sp_home' );
					 $view->view_back_sp();

			}


}
