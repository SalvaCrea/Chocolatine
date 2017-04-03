<?php

namespace salva_powa;

class sp_controller
{
      /**
       * The module by default
       */
      var $module_default = 'home';

      var $current_url;
      /**
       * Informations for Module executed
       */
      var $current_module = array(
        'name' => '',
        'slug' => '',
        'url'  => ''
      );
      /**
       *  Informations for sub Module executed
       */
      var $current_sub_module = array(
        'name' => '',
        'slug' => '',
        'url'  => ''
      );

      function __construct()
      {

      }
      function __get( $name )
    	{

    		if ( $name == 'core' )
    			 return sp_core();

    	}
}

 ?>
