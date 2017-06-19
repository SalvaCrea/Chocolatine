<?php

namespace salva_powa;

class sp_module_manager
{
			/**
			 * the list items int the menu
			 * @var array
			 */
			var $menu;
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
						$sp_core = sp_core();

						/**
						 * [$list_folder create a list of potentiel module ]
						 * @var [array]
						 */
						$list_folder = $this->create_root_folder( $sp_core->uri_folder.'/modules' );

						/**
						 *  search if the wordpress theme contain module for sp framework
						 */
						if ( file_exists ( get_template_directory() . '/sp_modules' ) ) {
							 $list_folder = array_merge(
								 $list_folder,
								 $this->create_root_folder( get_template_directory() . '/sp_modules' )
							 );
						}



						foreach ( $list_folder as $key => $folder_root ) {

									$file = $folder_root['root'] . '/' . $folder_root['name'] .'.php';
									$path_json = $folder_root['root'] . '/' . 'module.json';
									// test if file existe
									if ( !file_exists ( $file ) ) {
											continue;
									}

									/**
									 * [require the main file of module]
									 */
									require $file;

									// execute the class

									if ( file_exists ( $path_json ) ) {
											$test = '\perfect_module\perfect_module';
										  $current_class = new $test();
											sp_dump( $current_class );
									}
									else {
											$current_class = new $folder_root['name']();
									}
									$current_class->url = "/wp-admin/admin.php?page=salva_powa&module=" . $current_class->get_slug();
									/**
									 * Load the view of the module
									 */
									$current_class->loader_view();
									/**
									 * Load the component of the module
									 */
									$current_class->loader_component();
									/**
									 * Load the component of the module
									 */
									$current_class->loader_ajax_action();

									/**
									 * Add the module in the list
									 */
									$this->list_modules[ $current_class->get_slug() ] = $current_class;

						}

			}
			/**
			 * create a folder with all root clean
			 * @param  [string] $root_dir   the root folder
			 * @return [array]  $table with all root
			 */
			private function create_root_folder( $root_dir )
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
					if ( isset( $this->list_modules[ $module ] ) ) {

							$module =  $this->list_modules[ $module ];
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
