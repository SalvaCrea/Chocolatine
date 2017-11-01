<?php
namespace sp_framework;

use \sp_framework\Core;
/**
 * Return the core
 * @return object the core
 */
function get_core()
{
    return Core::get_core();
}
/**
 * Return the path folder theme
 * @return string return the path folder of the theme
 */
function get_theme(){
    if ( empty( $theme = get_configuration( 'main' )['theme'] ) ) {
      $theme = '_default_wp';
    }
    return  $theme;
}
/**
 * Return the folder of current theme
 * @return string path current theme
 */
function get_path_theme(){
    return get_folder() . '/themes/' . get_theme();
}
/**
 * Return folder of Sp Framework
 * @return string return the path folder
 */
function get_folder(){
    $core = get_core();
    return $core->path_folder;
}
/**
 * Return the model by module
 *
 * Can be name_model or module@name_model
 * @param  string the name of module find
 * @return mixed return false or container Model
 */
function get_model( $name_model, $maked = false )
{
    if ( !$maked ) {
        return  get_manager( 'model' )->find( $name_model );
    }else{
        return  get_manager( 'model' )->find( $name_model )->make();
    }
}
/**
 * Return the module by slug of not if module not find
 * @param  string the name of module find
 * @return mixed return false or obkect of class
 */
function get_module( $name_module )
{
    return get_core()->manager->module->get_module( $name_module );
}
/**
 * Return the configuration of ServiceManager
 * @param  $string name of configuration
 * @return mixed  return data mixed or false is empty
 */
function get_configuration( $name_configuration )
{
    return get_core()->manager->configuration->get_configuration( $name_configuration );
}
/**
 * Return a specific service
 * @param  string $name_service The name of service
 * @return mixed              the service if find or return false
 */
function get_service( $name_service )
{
    $service = get_core()->manager->service->get_service( $name_service );
    $service->getter();
    return $service;
}
/**
 * Return a specific manager
 * @param  string $manager The name of service
 * @return mixed              the manager if find or return false
 */
function get_manager( $name_service )
{
    if ( !empty( get_core()->manager->$name_service ) ) {
        return get_core()->manager->$name_service;
    }
    return false;
}
/**
 * The dev function that print pretty result
 * @param  mixed array, string, int, ....
 * @param  boolean $ajax  if ajax is true also return in the console js
 */
function dump($var=false, $ajax=false)
{
    if ( !$ajax ) {
      $debug = debug_backtrace();
      echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>' . $debug[0]['file'] . ' </strong> l.' . $debug[0]['line'] . '</a></p>';
      echo '<ol style="display:none;">';
      foreach ($debug as $k => $v) {
          if ($k > 0) {
              echo '<li><strong>' . $v['file'] . '</strong> l.' . $v['line'] . '</li>';
          }
      }
      echo '</ol>';
      echo '<pre>';
      print_r($var);
      echo '</pre>';
    }else{
      $var = json_encode( $var );
      echo "
      <script>
      dump = {$var};
      console.log( dump );
      </script>
      ";
    }

}


/**
 * Clean chain of string
 * @param  string no clean
 * @return string clean
 */
function clean_string( $string )
{
    $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.

   return strtolower(preg_replace('/[^A-Za-z0-9\-\_]/', '', $string)); // Removes special chars.
}
/**
    * This function find in array a key if exist
 * @param  mixed  $array          Array or Object for search
 * @param  string $key_research   the key of research
 * @param  mixed $value_research the value of research
 * @return mixed ( int|array|false )                int with the good key number or boolean false if if key not find
 */
 function array_find($array, $key_research, $value_research)
 {
    $type = gettype ( $array );
    $key = false;

    foreach ( $array as $current_key => $value ) {
      if ( is_object ( $value ) ) {
        $value = $value->{$key_research};
      }
      if ( is_array( $value ) ) {
        $value = $value[$key_research];
      }
      if ( $value == $value_research ) {

        $key = $current_key;
        break;
      }
    }

    return $key;
 }
 /**
  * Function use for find sereval object
  * @param  mixed  $array          Array or Object for search
  * @param  string $key_research   the key of research
  * @param  mixed $value_research the value of research
  * @param  string $operator       can it = | != | > | <
  * @return mixed  false | or array
  */
 function array_clean( $array, $key_research, $value_research, $operator = '=' ){

    $array_clean = [];

    foreach ( $array as $key => $value) {

      $current_value = (array) $value;

      if ( $current_value[ $key_research ] ==  $value_research ) {
        $array_clean []= $value;
      }
    }
    if ( !empty( $array_clean ) ) {
      return $array_clean;
    }
    return false;
 }

 /**
  * Return true if the use admin of sp framework
  * @return boolean
  */
 function is_admin()
 {
     if ( 'admin' == get_core()->etat ) {
         return true;
     }
     return false;
 }
 /**
  * Return true if the use api of sp framework
  * @return boolean
  */
 function is_api()
 {
     if ( 'api' == get_core()->etat ) {
         return true;
     }
     return false;
 }
 /**
  * Return true if the use front of sp framework
  * @return boolean
  */
 function is_front()
 {
     if ( 'front' == get_core()->etat ) {
         return true;
     }
     return false;
 }
/**
 *  The function check is the dev
 * @return boolean True if the dev site
 */
function is_dev()
{
    if ( get_core()->is_dev ) {
        return true;
    }
    return false;
}

/**
 *  create a loader in js
 * @return boolean true if the action is good
 */
function create_loader_js()
{
  echo "
    <div class='uil-ring-css' id='animation_loader'>
      <div>
      </div>
    </div>
    <style>
    #AdminContenair
    {
      display: none;
    }
    </style>
  ";
  return true;
}
/**
 * [Create redirection in js]
 * @param  string $url Create a redirection on JavaScript
 */
function redirection_js( $url )
{
  echo "
  <SCRIPT LANGUAGE=\"JavaScript\">
      document.location.href=\"{$url}\"
  </SCRIPT>
  ";
}
/**
 *  Scan the content folder
 * @param  string  $path_folder THe path of folder
 * @param  boolean $clean       True for clean list
 * @return array list folder
 */
function scanfolder( $path_folder, $clean = true )
{
    $list = scandir( $path_folder );
    if ( $clean ) {
      return array_diff( scandir( $path_folder ), array('..', '.') );
    }
    return $list;
}
/**
 * Return the name of folder of file
 * @param  [type] $file [description]
 * @return [type]       [description]
 */
function sp_get_current_name_folder( $file )
{
  if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
      $separator = '\\';
  } else {
      $separator = '/';
  }
  $position = strrpos( $file ,$separator );
  $name_folder =  substr( $file ,$position + 1 );
  return $name_folder;
}
/**
 * Create a content for the module templator
 * @param  string  $block_name
 * @param  mixed   $content
 * @param  string  $type
 * @param  integer $order
 */
function add_block(  $block_name, $content, $type = '',  $order = 0)
{

      $block = new Pattern\Container\Block();
      $block->create( $block_name, $content, $type , $order );

      $manager = \sp_framework\get_manager( 'block' );
      $manager->add_block( $block );

}
/**
 * Function used for add items in the menu
 * @param array $args all params for create items menu
 *
*/
 // $default_args = array(
 //   'route'     => '/home',
 //   'view'      => 'module/view',
 //   'text'      => 'Home',
 //   'icon'      => 'fa fa-text',
 //   'order'     => '5',
 //   'menu_name' => 'main_menu'
 // );

function add_item_menu( array $args ){

      $itemMenu = new Pattern\Container\ItemMenu();
      $itemMenu->create( $args );

      $mananger = \sp_framework\get_manager( 'menu' );
      $mananger->add_item_menu( $itemMenu );

}
