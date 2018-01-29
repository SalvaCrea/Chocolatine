<?php

/**
 * Plugin Name: Sp-Framework
 * Plugin URI: http://salva-crea.fr
 * Description: This plugin is extension for  custom your work site
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

Chocolatine\Core::create_core();

$a = Chocolatine\get_core();
Chocolatine\dump($a);
