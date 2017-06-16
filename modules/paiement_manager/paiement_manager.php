<?php

use \salva_powa\sp_module;

class paiement_manager extends sp_module
{
    function __construct()
    {
        $this->icon = 'fa-exchange';
				$this->name = 'Gestion des abonements';
				$this->description = "Gestions des abonements de Tripconnexion";
        $this->slug = "paiement_manager";
        $this->categorie = "tripconnexion";
        $this->show_in_menu = true;
    }
    function loader_view()
    {
      $view_one_request = array(
        'name' => 'Voir une requête',
        'slug' => 'view_one_request',
        'call_back' => 'view_one_request',
        'show_in_menu' => false
      );

      if ( $_GET['component'] == 'view_one_request' )
          $view_one_request['show_in_menu'] = true;

      $this->add_component( $view_one_request );

    }
    /***************************************************************************
    *
    * List of the sub module
    *
    ***************************************************************************/

    function loader_component()
    {

      $this->add_component(
        array(
          'name' => 'Création d\'un abonné',
          'call_back' => 'view_create_request_subcription',
          'component' => 'create_request_subcription',
          'slug' => 'rq_subcription',
          'show_in_menu' => true
        )
      );

      $this->add_component(
        array(
          'name' => 'Création d\'un abonnement',
          'call_back' => 'view_create_plan',
          'component' => 'create_plan',
          'slug' => 'plan',
          'show_in_menu' => true
        )
      );

      $this->add_component(
        array(
          'name' => 'View for the subscription of paiement',
          'component' => 'view_front_subscription',
          'slug' => 'view_front',
          'show_in_menu' => false
        )
      );

      $this->add_component(
        array(
          'name' => 'Mette à jour les informations',
          'component' => 'tools_subscription',
          'call_back' => 'view_tools_subscription',
          'slug' => 'tool',
          'show_in_menu' => true
        )
      );

    }
    /***************************************************************************
    *
    * List of the ajax action
    *
    ***************************************************************************/
    function loader_ajax_action()
    {
        $this->add_ajax_action(
            array(
              'name' => 'Find user on Sellsy',
              'call_back' => 'find_user_sellsy_by_mail',
              'component' => 'find_user_sellsy_by_mail'
            )
        );

        $this->add_ajax_action(
            array(
              'name' => 'Re Send Mail For Subscription',
              'call_back' => 'send_request_mail',
              'component' => 'send_request_mail'
            )
        );

    }

    /***************************************************************************
    *
    *   Ajax action functions
    *
    ***************************************************************************/

    function find_user_sellsy_by_mail( $args )
    {

        $email = $args['args']['email'];
        $sellsy_api = sp_get_module('sellsy_api');
        $client = $sellsy_api->tool->find_client( array('email' => $email ) );

        if ( empty( $client ) ){
            return $client = [];
        }
        else{
            return $client->response->result;
        }

    }
    function send_request_mail( $req_ajax )
    {

        $id_request_subscription = $req_ajax['args']['ID'];
        $this->rq_subcription->send_mail_request_subscription( $id_request_subscription );

        return true;
    }
    /***************************************************************************
    *
    *   The views
    *
    ***************************************************************************/
    function view_back()
    {

      $post_manager = sp_get_module('sp_wp_post');
      $stripe = sp_get_module('sp_stripe');



      $args = array(
          'post_type' => $this->rq_subcription->data_schema()['post_type'],
          'posts_per_page' => 40
      );

      $list_request_subscription = $post_manager->find_post_full( $args, true );
      $this->add_module_js('home_paiement_manager.js', 'list_request_subscription', $list_request_subscription);

      $module_show_request = array_find( $this->component, 'slug', 'view_one_request' );
      $this->convert_in_js('url_show_request', $this->component[$module_show_request]['url'] );

      $view =  $this->twig_render( 'home_paiement_manager.html');

      return $view;

    }
    function view_create_request_subcription()
		{
      $this->add_module_js('create_request_subcription.js');

      $form = $this->rq_subcription->generate_form();

      $view =  $this->twig_render( 'create_request_subcription.html',
          array( 'form' => $form )
      );

      return $view;
		}
    function view_create_plan()
    {

      $form  = $this->plan->generate_form();

      $view =  $this->twig_render( 'create_plan.html',
          array( 'form' => $form )
      );

      return $view;
    }
    function view_one_request()
    {

        $sellsy_api = sp_get_module('sellsy_api');

        $id_request = $_GET['id_request'];

        $request = $this->rq_subcription->get_one( $id_request );

        $this->add_module_js('view_one_request.js', "request", $request);

        $view = $this->twig_render('view_one_request.html', $request);

        return $view;

    }
    function view_tools_subscription()
    {

      $customer = $this->tool->verify_customer_on_stripe();

      $view = $this->twig_render('tools_subscription.html',
        array(
          'test_var' => $customer
        ));

      return $view;

    }


}
