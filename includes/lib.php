<?php



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

   return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
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

    if ( $_GET['page'] == $sp_core->slug &&  is_admin() )
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
