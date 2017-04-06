<?php

namespace salva_powa;

class sp_controller
{
      /**
       * The base of url of sp core
       * @var string
       */
      var $url;
      /**
       * The module by default
       */
      var $module_default = 'home';
      /**
			 * the url url current
			 * @var string
			 */
      var $current_url;
      /**
       * Informations for Module executed
       */
      var $current_module = array(
        // 'name' => '',
        // 'slug' => '',
        // 'url'  => ''
      );
      /**
       *  Informations for sub Module executed
       */
      var $current_module_action = array(
        // 'name' => '',
        // 'slug' => '',
        // 'url'  => ''
      );


      function __construct()
      {
          $this->url =  "/wp-admin/admin.php?page={$this->core->slug}";
      }
      function init()
      {
        $this->get_current_module();

        $this->get_current_url();
      }
      function __get( $name )
    	{

    		if ( $name == 'core' )
    			 return sp_core();

    	}
			/**
			 * Find the current module by the url
			 * @return [string] return the current module
			 */
			public function get_current_module()
			{

				$current_module_action = false;

				if ( isset( $_GET['module'] ) && !empty( $_GET['module'] ) )
				{
							$this->current_module = $this->core->modules->get_module( $_GET['module'] );
				}
				else
				{
						 $this->current_module = $this->core->modules->get_module( $this->module_default );
				}

				if ( isset( $_GET['module_action'] ) && !empty( $_GET['module_action'] ) ) {

						$this->module_action = $_GET['module_action'];

						$current_module_action = array_find(
              $this->current_module->module_action,
              'slug',
              $this->module_action
            );

						if ( $current_module_action != false ) {

								$this->current_module_action = $this->current_module->module_action[$current_module_action];

            }

				}


			}
      /**
       * General a url for the wp-admin
       * @return string
       */
      public function get_current_url()
      {

          $url = $this->url;

          if ( !empty( $this->current_module->slug ))
            $url .= "&module={$this->current_module->slug}";

          if ( !empty( $this->module_action ) )
            $url .= "&module_action={$this->module_action}";

          $this->current_url = $url;

          return $url;

      }

}

 ?>
