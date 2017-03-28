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
						global $sp_core;

						$list_folder = $this->create_root_folder( $sp_core->uri_folder.'/modules' );



							if ( file_exists ( get_template_directory() . '/sp_modules' ) ) {
								 $list_folder = array_merge(
									 $list_folder,
									 $this->create_root_folder( get_template_directory() . '/sp_modules' )
								 );
							}



						foreach ( $list_folder as $key => $folder_root ) {

									$folder = $folder_root['root'] . '/' . $folder_root['name'] .'.php';

									// test if file existe
									if ( !file_exists ( $folder ) ) {
											continue;
									}

									require $folder;

									// execute the class
									$current_class = new $folder_root['name']();

									$current_class->parent_construct();

									$current_class->slug = $current_class->slug;

									$this->list_modules[ $current_class->slug ] = $current_class;

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
}
