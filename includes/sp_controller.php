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
      var $module_default = 'sp_home';
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
       *  Informations for component executed
       */
      var $current_component = array(
        // 'name' => '',
        // 'slug' => '',
        // 'url'  => ''
      );
      /**
      * the list of views
      * @var array
       */
      var $views = array();

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

				$current_component = false;

				if ( isset( $_GET['module'] ) && !empty( $_GET['module'] ) )
				{
							$this->current_module = $this->core->modules->get_module( $_GET['module'] );
				}
				else
				{
						 $this->current_module = $this->core->modules->get_module( $this->module_default );
				}

				if ( isset( $_GET['component'] ) && !empty( $_GET['component'] ) ) {

						$this->component = $_GET['component'];

						$current_component = array_find(
              $this->current_module->component,
              'slug',
              $this->component
            );

						if ( $current_component != false ) {

								$this->current_component = $this->current_module->component[$current_component];

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

          if ( !empty( $this->component ) )
            $url .= "&component={$this->component}";

          $this->current_url = $url;

          return $url;

      }

}

 ?>
