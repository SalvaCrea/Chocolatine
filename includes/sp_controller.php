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
       *  Informations for sub Module executed
       */
      var $current_sub_module = array(
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

				$current_sub_module = false;

				if ( isset( $_GET['module'] ) && !empty( $_GET['module'] ) )
				{
							$this->current_module = $this->core->modules->get_module( $_GET['module'] );
				}
				else
				{
						 $this->current_module = $this->core->modules->get_module( $this->module_default );
				}

				if ( isset( $_GET['sub_module'] ) && !empty( $_GET['sub_module'] ) ) {

						$this->sub_module = $_GET['sub_module'];

						$current_sub_module = array_find(
              $this->current_module->sub_module,
              'slug',
              $this->sub_module
            );

						if ( $current_sub_module != false ) {

								$this->current_sub_module = $this->current_module->sub_module[$current_sub_module];

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

          if ( !empty( $this->sub_module ) )
            $url .= "&sub_module={$this->sub_module}";

          $this->current_url = $url;

          return $url;

      }

}

 ?>
