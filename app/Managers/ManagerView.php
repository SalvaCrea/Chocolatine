<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerView extends Manager
{
  public $name = 'view';
  /**
   * [add_form add a view]
   * @param [array] $args [description contain inviewation for add view]
   */
  function add_view( $args )
  {
      $this->container []=  $args;
  }
  /**
   *  Get one view
   *  $view = 'nameVieww'
   *  or
   *  $view = 'nameModule/nameView'
   * @return string name of view
   */
  function get_view( string $view ){

        $view = explode( "/", $view);

        /**
         *
         *    Check if module isset
         *
         */
        if ( !empty( $view[1] ) ) {

          $module = $view[0];
          $view = $view[1];

        }else{
            $view = $view[0];
        }

        /**
         *
         *    Search View in the container 
         *
         */
        foreach ( $this->container  as $key => $current_view) {
            if ( isset( $module ) ) {
              if ( $current_view['module'] == $module && $current_view['name'] == $view ) {
                  return $current_view;
              }
            }else{
              if ( $current_view['name'] == $view ) {
                  return $current_view;
              }
            }

        }
        return false;

  }

}
