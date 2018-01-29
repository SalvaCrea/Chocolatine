<?php

namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;

class ManagerAjax extends Manager
{
  public $name = 'ajax';
  /**
   * Contain Post Request
   * @var object
   */
  public $request;
  /**
   * [__construct description]
   */
		function __construct()
    {

				// add_action( 'wp_ajax_Chocolatine_ajax_controller', array( $this ,'controller') );
				// add_action('wp_ajax_nopriv_Chocolatine_ajax_controller', array( $this ,'controller') );

    }
    function __get( $name )
    {

      if ( $name == 'core' )
         return \Chocolatine\get_core();

    }
    /**
     * [add_ressource Add the main ressource for the transaction ajax]
     */
		function add_ressource()
		{

				wp_enqueue_script(
					'sp_ajax_controller',
				$this->core->url_folder . '/assets/js/sp_ajax.js'
				);

		}
    /**
     * [add_ajax_listen add one action for the ajax control]
     * @param [type] $args [description]
     */
		function add_ajax_listen( $args )
		{

				$args_default = array(
						'role' => ['administrator'],
						'module' => '',
						'call_back' => ''
				);

			 $args = array_merge( $args_default, $args );

			 $this->list_ajax []= $args;

		}
    function controller()
    {
      $this->request = \Chocolatine\Request\RequestAjax( $_POST );

			// test if the requet javascript is good
			if ( !empty( $this->args['component'] )
					 && !empty( $this->args['module'] )
			) {

					$find_module = false;
					foreach ($this->list_ajax as $key => $ajax_action) {

							if ( $this->args['module'] == $ajax_action['module']
						 				&& $this->args['component'] == $ajax_action['component'] ) {

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
					$module = $this->core->manager->module->get_module( $ajax_current_actions['module'] );

					// execute  the callback
					$this->response['data'] = call_user_func(
						array(
							$module,
							$ajax_current_actions['call_back']
						),
						$this->args
					);

					echo json_encode( $this->response );

					unset( $this->ajax_current_actions );

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
