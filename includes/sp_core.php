<?php
/**
 * Class sp_core
 */

namespace salva_powa;

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

			function __construct()
			{
				$this->uri_folder = dirname( dirname(__FILE__) );
				$this->url_folder = plugins_url( 'salva-powa-wordpress' );

				// register twig
				//Twig_Autoloader::register();
			}
			/**
			 * Contains the tasks to be executed in the wordpress administration part
			 */
			function wp_admin_do()
			{


					 $this->module_manager = new sp_module_manager();
					 $this->module_manager->search_modules();

					 // add ressource for the plugin
					 add_action('admin_head', array( $this, 'sp_ressource' ));

					 add_action('admin_menu', array( $this, 'create_menu' ));

			}
			function create_menu()
			{

					 add_menu_page('Salva Powa', 'Salva Powa', 'administrator', __CLASS__, array( $this,'back_view' ),   'dashicons-hammer', 1);

					 foreach ($this->module_manager->list_modules as $key => $module) {

						 add_submenu_page(
				         __CLASS__,
				         $module->name,
				         $module->name,
				         'administrator',
				         $module->slug,
				         array( $this,'back_view' )
				     );

					 }

			}
			function back_view()
			{

					 $view = new \sp_home();
					 $view->view_back_sp();

			}
			function sp_ressource()
			{

		    wp_deregister_script( 'jquery' );
				wp_enqueue_script( 'Jquery', $this->url_folder . '/bower_components/jquery/dist/jquery.min.js' );
				wp_enqueue_script( 'Angular', $this->url_folder . '/bower_components/angular/angular.min.js' );
		    wp_enqueue_style( 'sp_styleCss', $this->url_folder . '/assets/css/style.css' );
		    wp_enqueue_style( 'sp_boostrapCss', $this->url_folder . '/bower_components/bootstrap/dist/css/bootstrap.css' );
		    wp_enqueue_script( 'sp_boostrapJs', $this->url_folder . '/bower_components/bootstrap/dist/js/bootstrap.js' );

				wp_enqueue_style( 'font_awesome', $this->url_folder . '/bower_components/font-awesome/css/font-awesome.css' );
				wp_enqueue_style( 'font_roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900');


			}
}
