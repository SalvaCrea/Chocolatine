<?php

namespace salva_powa;

class sp_ajax
{
    /**
     * The argument in request ajax
     */
    var $args = array();
		/**
		 * An array than contain the callback by ajax
		 * @var ajax_actions
		 */
		var $ajax_actions = array();
		/**
		 * The current action selected
		 * @var ajax_actions
		 */
		var $ajax_current_actions = array();
    /**
		 * This should javascript variable
		 * @var array
		 */
		var $convert_in_js = array();
  /**
   * [__construct description]
   */
		function __construct()
    {

				add_action( 'wp_ajax_sp_ajax_controller', array( $this ,'controller') );
				add_action('wp_ajax_nopriv_sp_ajax_controller', array( $this ,'controller') );

    }
    function __get( $name )
    {

      if ( $name == 'core' )
         return sp_core();

    }
		function add_ressource()
		{

				wp_enqueue_script(
					'sp_ajax_controller',
				$this->core->url_folder . '/assets/js/sp_ajax.js'
				);

		}
		function add_ajax_listen( $args )
		{

				$args_default = array(
						'role' => ['administrator'],
						'module' => '',
						'call_back' => ''
				);

			 $args = array_merge( $args_default, $args );

			 $this->ajax_actions []= $args;

		}
    function controller()
    {
			$this->args = $_POST;

			// test if the requet javascript is good
			if ( !empty( $this->args['sub_module'] )
					 && !empty( $this->args['module'] )
			) {

					$find_module = false;
					foreach ($this->ajax_actions as $key => $ajax_action) {

							if ( $this->args['module'] == $ajax_action['module']
						 				&& $this->args['sub_module'] == $ajax_action['sub_module'] ) {

											$find_module = true;
											$this->execute_call_back( $ajax_action );

							}
					}
					if ( !$find_module ) {
							wp_die();
					}

			}
			else{
					wp_die();
			}

    }
		/**
		 * Execute the call back by the ajax requete
		 * @param  Arguement of requet
		 */
		function execute_call_back( $ajax_current_actions )
		{

					$this->ajax_current_actions = $ajax_current_actions;

					if ( !$this->security_role() )
										return false;

					// get the module
					$module = $this->core->modules->get_module( $ajax_current_actions['module'] );

					// execute  the callback
					$reponse = call_user_func(
						array(
							$module,
							$ajax_current_actions['call_back']
						),
						$this->args
					);

					echo json_encode( $reponse );

					$this->ajax_current_actions = array();

					wp_die();
		}
		function security_role()
		{
					global $current_user;

					if ( in_array ( $this->ajax_current_actions['role'][0], (array) $current_user->roles)) {

					    return true;

					}
					else
					{

							wp_die();

					}
		}

}

 ?>
