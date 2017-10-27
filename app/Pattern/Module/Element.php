<?php
namespace sp_framework\Pattern\Module;

class Element
{
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
