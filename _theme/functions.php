<?php
/**
 * salva-powa functions and definitions
 *
 * @link https://salva-crea.fr
 *
 * @package salva-powa
 */

use \sp_framework\sp_controller;

global $require_files;

// Create the variable has contain all files at include in the current current theme
if ( !isset( $require_files ) )
			$require_files = array();

$require_files []= '/functions_extend/config_ressources.php';

foreach ( $require_files as $patch ) {
	  require get_template_directory() . $patch;
}
