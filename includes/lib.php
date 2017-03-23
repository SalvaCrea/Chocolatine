<?php

/**
 * The dev function that print pretty result
 * @param  accpet array, string, int, ....
 * @param  boolean $ajax  if ajax is true also return in the console js
 */
function sp_dump( $array=false, $ajax=false ) {

    if ($array===false) { return false; }
    if (!$ajax) {
    echo '<pre>'.print_r($array, true).'</pre>';
    }
    if ($ajax) {
        $a = json_encode($array);
        echo "
            <script>
            console.log(".$a.");
            </script>
        ";
    }

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
