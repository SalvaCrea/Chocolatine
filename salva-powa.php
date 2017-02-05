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

 function pippin_taxonomy_add_new_meta_field() {
 	// this will add the custom meta field to the add new term page
 	?>
 	<div class="form-field">
 		<label for="term_meta[custom_term_meta]"><?php _e( 'Example meta field', 'pippin' ); ?></label>
 		<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
 		<p class="description"><?php _e( 'Enter a value for this field','pippin' ); ?></p>
 	</div>
 <?php
 }
 add_action( 'category_add_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );
 
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
