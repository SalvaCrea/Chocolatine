<?php

/**
 * Plugin Name: Sp-Framework
 * Plugin URI: http://salva-crea.fr
 * Description: This plugin is extension for wordpress for custom your work site
 * Version: 3.0.0
 * Author: Salvador Cardona
 * Author URI: http://salva-crea.fr
 * License: GPL2
 */

/**
 * Load the auto loader
 */
require "auto_load.php";

// create empty object

$sp_core = new stdClass();


$sp_core = sp_framework\sp_core::get_sp_core();
