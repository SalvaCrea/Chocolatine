<?php

namespace sp_framework\Managers;

use sp_framework;
use sp_framework\Pattern\Manager;

class ManagerModule extends Manager
{
			public $name = 'module';
			/**
			 * return les items in the modules
			 * @return [type] [description]
			 */
			public function search_modules()
			{
						$sp_core = sp_framework\get_core();

						/**
						 * [$list_folder create a list of potentiel module ]
						 * @var [array]
						 */
						$list_folder = $this->create_list_folder( $sp_core->path_folder.'/app/modules' );


						foreach ( $list_folder as $key => $folder_root ) {

									$file = $folder_root['root'] . '/' . $folder_root['name'] .'.php';
									$path_json = $folder_root['root'] . '/' . 'module.json';

									// test if file existe
									if ( file_exists ( $file ) ) {
											continue;
									}

									// execute the class

									if ( file_exists ( $path_json ) ) {
											$module_factory = new sp_framework\ModuleFactory();
											$current_module = $module_factory->build_module( $folder_root['root'] );
									}
									/**
									 * Load the view of the module
									 */
									$current_module->after_factory();

									/**
									 * Add the module in the list
									 */
									$this->add_module( $current_module );

						}

						/**
						 * [Action then all module charged]
						 */
						do_action( 'modules_loaded' );

			}
			public function add_module( $module )
			{
					array_push( $this->container, $module );
			}
			/**
			 * create a folder with all root clean
			 * @param  [string] $root_dir   the root folder
			 * @return [array]  $table with all root
			 */
			private function create_list_folder( $root_dir )
			{

					$array_root = [];

					$array_root = scandir( $root_dir );

					// delete inutile occurence
					$array_root = array_diff( $array_root, array( '.', '..') );

					foreach ( $array_root as $key => $value) {

						$array_root[$key] = array(
							'root' => $root_dir . '/' . $value,
							'name' => $value
						);

					}

					return $array_root;
			}
			/**
			 * This function return un module by the name
			 * @param  [string] the slug of the module for find
			 * @param  [boolean] execute true or false getter
			 * @return [Mixed]   Return Object if find or false is not find
			 */
			public function get_module( $module, $getter = true )
			{
					if ( isset( $this->container[ $module ] ) ) {

							$module =  $this->container[ $module ];
							/**
							 * Execute the getter of the module
							 */
							if ( $getter )
									$module->getter();

							return $module;

					}
					else
					{
							return false;
					}

			}
}
