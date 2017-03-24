<?php

namespace salva_powa;

class sp_ajax
{
    //  (string) l'action que doit effectuer le code
    var $action = '';
    //  (array) arguments envoyé en ajax
    var $args = array();
    // (array) id des pots selectionnés
    var $id_posts = array();
    // id users id des users selectionné
    var $id_users = array();
    // (array) le retour attendu par le, do permet de savoir si l'action à bien été faite
    var $return_r = array(
			'do'=>false,
			'data' => array()
		);
		/**
		 * An array than contain the callback by ajax
		 * @var ajax
		 */
		var $ajax_listen = array();

		function __construct()
    {
				global $sp_core;

        $this->icon = 'fa-tasks';
				$this->name = 'Ajax Controller';
				$this->description = "The class for the awesome ajax";

				add_action( 'wp_ajax_sp_ajax_controller', array( $this ,'controller') );
				add_action('wp_ajax_nopriv_sp_ajax_controller', array( $this ,'controller') );

    }
		function add_ressource()
		{
				$sp_core = sp_core();

				wp_enqueue_script(
					'sp_ajax_controller',
				$sp_core->url_folder . '/assets/js/sp_ajax.js'
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

			 $this->ajax_listen []= $args;

		}
		function view_back()
		{
			return 'un jour j\'aurais une vue';
		}
    function controller()
    {

			wp_die();

    }

    // fonction pour dire que avec le ajax on est copain et que c'est bien retourné
    function valid_return()
    {
        $this->return_r['do'] = true;
    }



}

 ?>
