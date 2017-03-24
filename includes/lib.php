<?php

/**
 * The dev function that print pretty result
 * @param  accpet array, string, int, ....
 * @param  boolean $ajax  if ajax is true also return in the console js
 */
function sp_dump( $var=false, $ajax=false ) {

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
 * add ressource for sp_powa in the back
 */
function sp_ressource()
{

    // delete Jquery ressource of Wordpress
    wp_deregister_script( 'jquery' );
    // personnal style sheet
    wp_enqueue_style( 'styleCss',$sp['url'] . '/css/style.css' );

    wp_enqueue_style( 'boostrapCss',$sp['url'] . '/bower_components/bootstrap/dist/css/bootstrap.css' );
    wp_enqueue_script( 'boostrapJs',$sp['url'] . '/bower_components/bootstrap/dist/js/bootstrap.js' );

}

/**
 * Clean chain of string
 * @param  string no clean
 * @return string clean
 */
function sp_clean_string( $string ) {
   $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.

   return strtolower( preg_replace('/[^A-Za-z0-9\-]/', '', $string) ); // Removes special chars.
 }

 function sp_core()
 {
	 	global $sp_core;

	 	return $sp_core;
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

     if (isset($data, $limit) === true)
     {

         $result = range(1, ceil($data / $limit));

         if (isset($current, $adjacents) === true)
         {
             if (($adjacents = floor($adjacents / 2) * 2 + 1) >= 1)
             {
                 $result = array_slice($result, max(0, min(count($result) - $adjacents, intval($current) - ceil($adjacents / 2))), $adjacents);
             }
         }
     }

     return $result;
 }
