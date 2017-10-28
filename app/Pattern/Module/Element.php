<?php
namespace sp_framework\Pattern\Module;

class Element
{
    function __get( $name )
    {

      if ( $name == 'core' ){
          return \sp_framework\get_core();
      }


      if ( $name == 'db' ){
          return \sp_framework\get_service( 'database' )->database;
      }


    }
    /**
     * use for get the module
     */
     public function get_father(){
          echo __CLASS__;
     }
     public function renderTemplate(){
       $render = \sp_framework\get_service( 'templator' );
       /**
        * generate the template
        */

       $render->renderer();
     }
}
