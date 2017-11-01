<?php

namespace sp_framework\Managers;

use sp_framework;
use sp_framework\Pattern\Manager;

class ManagerModule extends Manager
{
			public $name = 'module';
			/**
			 * the list of module disponible
			 * @var array
			 */
			var $list_modules;
			/**
			 * return les items in the modules
			 * @return [type] [description]
			 */
			public function search_modules()
			{

						/**
						 * [$list_folder create a list of potentiel module ]
						 * @var [array]
						 */
						$paths_folder = [
							sp_framework\get_core()->path_folder.'/app/Modules'
						];

						$path_module_theme = sp_framework\get_path_theme() . '/Modules';

						if ( is_dir( $path_module_theme ) ) {
							$paths_folder []= $path_module_theme;
						}
						foreach ( $paths_folder as $value) {
								$this->search_module_in_folder( $value );
						}
			}
			/**
			 * Search module by the path
			 * @param  string $path_folder the path folder
			 */
			public function search_module_in_folder( $path_folder_modules ){

				$list_folder = $this->create_list_folder( $path_folder_modules );

				$module_factory = new sp_framework\ModuleFactory();

				foreach ( $list_folder as $key => $folder_root ) {

							$file = $folder_root['root'] . '/' . $folder_root['name'] .'.php';

							$current_module_namespace = "\\sp_framework\\Modules\\{$folder_root['name']}";

							$current_module = $module_factory->build_module( $folder_root['name'], $folder_root['root'], $current_module_namespace );

							/**
							 * Load the view of the module
							 */
							$current_module->after_factory();

							$args = [
								"name" => $folder_root['name'],
								"module" => $folder_root['name'],
								"namespace" => $current_module_namespace,
								"instance" => $current_module
							];

							array_push( $this->container, $args );

				}

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
			 * @param  string tthe name of the module for find
			 * @param  boolean execute true or false getter
			 * @return Mixed   Return Object if find or false is not find
			 */
			public function get_module( $module_name, $getter = true )
			{
					if ( false !== $key = \sp_framework\array_find( $this->container, 'name', $module_name )  ) {

							$module = $this->container[$key]['instance'];

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
