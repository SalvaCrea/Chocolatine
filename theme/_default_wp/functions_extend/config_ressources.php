<?php
/**
 * salva-powa
 *
 * @link https://salva-crea.fr
 *
 * @package salva-powa
 *
 *
 * Function that load Ressources Js and Css
 *
 */


// load the main ressources for the theme
function main_ressources()
{

  global $sp;

  // Boostrap js
  wp_register_script( 'materialize_js' , 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js' );
  wp_enqueue_script('materialize_js');

  // Angular JS
  wp_register_script( 'angular_js' , $sp['url'] . '/bower_components/angular.min.js' );
  wp_enqueue_script('angular_js');
  // function js for the theme
  wp_register_script( 'functions_js' , get_template_directory_uri() . '/www/js/functions_js.js', array() , null, true );
  wp_enqueue_script('functions_js');
  // Boostrap Css
  wp_enqueue_style( 'materialize_css' , 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css' );
  // main style for the theme
  wp_enqueue_style( 'styleCss' , get_template_directory_uri() . '/www/css/style.css' );

}

add_action('wp_enqueue_scripts', 'main_ressources');

// Delete the jQuery of Wordpress And add Jquery 3.0
function modify_jquery()
{

  	// comment out the next two lines to load the local copy of jQuery
  	wp_deregister_script('jquery');
  	wp_register_script('jquery', 'https://code.jquery.com/jquery-3.1.1.min.js', false, '2.1.4');
  	wp_enqueue_script('jquery');

}

if ( !is_admin() ) {
  add_action('wp_enqueue_scripts', 'modify_jquery');
}
