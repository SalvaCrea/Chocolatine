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


						$list_folder = scandir( $sp_core->uri_folder.'/modules' );
						// remove parent folder
						$list_folder = array_diff( $list_folder, array( '.', '..') );

						foreach ( $list_folder as $key => $folder ) {

									$file_path = $sp_core->uri_folder.'/modules/' . $folder . '/' . $folder . '.php';
									// test if file existe
									if ( !file_exists ( $file_path ) ) {
											continue;
									}

									require $file_path;

									// execute the class
									$current_class = new $folder();
									$current_class->slug = 'sp_' . sp_clean_string( $current_class->name );
									$this->list_modules[ $current_class->slug ] = $current_class;

						}

			}
}
