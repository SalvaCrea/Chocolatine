<?php
/**
 * Class sp_core
 */

namespace sp_framework;

class Core
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

			public function __construct()
			{

				$this->path_folder = dirname( dirname(__FILE__) );
				$this->url_folder = '/wp-content/plugins/' . sp_get_current_name_folder( $this->path_folder );

			}
			/**
			 * Function create the core
			 * @return object Create the core
			 */
			public static function create_core(){
					self::$sp_core = new Core();
					return self::$sp_core->init();
			}
			public static function get_core(){
					return self::$sp_core;
			}
			/**
			 * This function load all modules
			 */
			public function init()
			{

				$this->manager = new Managers\ManagerMaster();

				$this->manager->module->search_modules();

			}

}
