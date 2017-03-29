<?php

use \salva_powa\sp_module;

class sp_query_post extends sp_module
{

    function __construct()
    {

        $this->icon = 'fa-spinner';
				$this->name = 'Sp Query Post';
				$this->description = "With me, you search personnal post and meta";

				if ( is_admin() ) {

					$this->show_in_menu = true;
					$this->start();

				}

				$this->add_ajax_action(
						array(
							'name' => 'Query Find Post',
							'call_back' => 'find_post',
							'action_module' => 'find_post_wp_post'
						)
				);

    }
		function find_post( $args )
		{
			 $query = new WP_Query( $args );
			 return $query;
		}

		function start()
		{
				$this->add_module_js( 'sp_query_post.js' );
		}
		function view_back()
		{
					return 'mange';
		}


}
