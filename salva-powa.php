<?php

/**
 * Plugin Name: Salva-Powa
 * Plugin URI: http://salva-crea.fr
 * Description: This plugin is extension for wordpress for custom your work site
 * Version: 1.0.0
 * Author: Salvador Cardona
 * Author URI: http://salva-crea.fr
 * License: GPL2
 */

require_once( dirname(__FILE__).'/auto_load.php' );

use \salva_powa\sp_core;

$sp_core = new sp_core();
$sp_core->wp_admin_do();
