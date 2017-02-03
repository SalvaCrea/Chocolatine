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

// The awesome global who content this informations not importants
$sp = array(
  'url' => plugin_dir_url( __FILE__ )
);

require_once(dirname(__FILE__).'/vendor/autoload.php');
require_once(dirname(__FILE__).'/lib/lib.php');
require_once(dirname(__FILE__).'/lib/menu/menu.php');

// add ressource js and css in module
add_action('admin_head', 'sp_ressource');

// init of twig
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem( dirname(__FILE__) . '/templates' ) ; // Dossier contenant les templates
$twig = new Twig_Environment( $loader, array(
  'cache' => false
));

function sp_home()
{
    require_once(dirname(__FILE__).'/lib/sp_home/sp_home_class.php');
    sp_home_class::view();
}

function sp_sub_menu()
{
  echo 'maquette0';
}
