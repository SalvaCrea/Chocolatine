<?php

/**
 * Plugin Name: Salva-Powa
 * Plugin URI: http://salva-crea.fr
 * Description: This plugin is extension for wordpress for custom your work site
 * Version: 3.0.0
 * Author: Salvador Cardona
 * Author URI: http://salva-crea.fr
 * License: GPL2
 */

use \salva_powa\sp_core;

/**
 * Load the auto loader
 */
require "auto_load.php";

/**
 * Load the config for Sp Framework
 */
require "sp_config.php";

$sp_core = new stdClass();

if (  is_admin() ) {

    sp_core_start();

}
