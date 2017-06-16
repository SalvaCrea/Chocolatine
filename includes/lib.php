<?php
use \salva_powa\sp_core;
/**
 * [sp_core return the core of sp framework]
 * @return [type] [description]
 */
function sp_core()
{
    global $sp_core;

    if ( !sp_core_exist() ) {
      $sp_core = sp_core_start();
    }

    return $sp_core;
}

/**
 * [ sp_core_start Create the main module for sp framework ]
 * @return [object] [return the core of sp framework]
 */
function sp_core_start()
{

    global $sp_config;
    global $sp_core;

    $sp_core = new sp_core();
    $sp_core->config = $sp_config;
    $sp_core->init();

    return $sp_core;
}
/**
 * [sp_core_exist Check if the function sp_core_start has runned]
 * @return [boolean] [false if a core is not present or true]
 */
function sp_core_exist()
{
    global $sp_core;
    if ( empty( (array) $sp_core ) ) {
      return false;
    }
    return true;
}
/**
 * The dev function that print pretty result
 * @param  accpet array, string, int, ....
 * @param  boolean $ajax  if ajax is true also return in the console js
 */
function sp_dump($var=false, $ajax=false)
{
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
}


/**
 * Clean chain of string
 * @param  string no clean
 * @return string clean
 */
function sp_clean_string($string)
{
    $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.

   return strtolower(preg_replace('/[^A-Za-z0-9\-\_]/', '', $string)); // Removes special chars.
}

/**
 * FUnction for utile pagination
 * @param [type] $data      [description]
 * @param [type] $limit     [description]
 * @param [type] $current   [description]
 * @param [type] $adjacents [description]
 */

 function sp_pagination($data, $limit = null, $current = null, $adjacents = null)
 {
     $result = array();

     if (isset($data, $limit) === true) {
         $result = range(1, ceil($data / $limit));

         if (isset($current, $adjacents) === true) {
             if (($adjacents = floor($adjacents / 2) * 2 + 1) >= 1) {
                 $result = array_slice($result, max(0, min(count($result) - $adjacents, intval($current) - ceil($adjacents / 2))), $adjacents);
             }
         }
     }

     return $result;
 }

/**
    * This function find in array a key if exist
 * @param  [type] $array          The subject of reseach
 * @param  [type] $key_research   the key of research
 * @param  [type] $value_research the value of research
 * @return mixed ( int|false )                int with the good key number or boolean false if if key not find
 */
 function array_find($array, $key_research, $value_research)
 {
    $array = (array) $array;

     foreach ($array as $key => $current_value) {
         if (isset($current_value[$key_research]) && $current_value[$key_research] == $value_research) {
             return $key;
         }
     }
     return false;
 }

 /**
  * Return true if the use admin of sp framework
  * @return Boolean
  */
 function is_sp_admin()
 {
    $sp_core = sp_core();

    if ( !empty( $_GET['page'] ) && $_GET['page'] == $sp_core->slug &&  is_admin() )
          return true;

    return false;
 }
/**
 *  The function check is the dev
 * @return Boolean True if the dev site
 */
function sp_dev()
{
    $core = sp_core();
    if ( $core->is_dev ) {
        return true;
    }
    return false;
}
/**
 * Return the module by slug of not if module not find
 * @param  string the name of module find
 * @return mixed return false or obkect of class
 */
function sp_get_module( $slug_module )
{
    $core = sp_core();
    return $core->modules->get_module( $slug_module );
}
/**
 *  create a loader in js
 * @return boolean true if the action is good
 */
function sp_create_loader_js()
{
  echo "
    <div class='uil-ring-css' id='animation_loader'>
      <div>
      </div>
    </div>
    <style>
    #adminmenumain
    {
      display: none;
    }
    </style>
  ";
  return true;
}
/**
 * [sp_get_current_name_folder description]
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
 * [Create redirection in js]
 * @param  [type] $url [description]
 */
function sp_redirection_js( $url )
{
  echo "
  <SCRIPT LANGUAGE=\"JavaScript\">
      document.location.href=\"{$url}\"
  </SCRIPT>
  ";
}
