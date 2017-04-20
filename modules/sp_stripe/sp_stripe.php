<?php

use \salva_powa\sp_module;

class sp_stripe extends sp_module
{

    var $config;

    function __construct()
    {

        $this->icon = 'fa-cart-arrow-down';
        $this->name = ' Api Stripe';
        $this->slug = 'sp_stripe';
        $this->description = "Managing Subscription Stripe";
        $this->show_in_menu = true;
        $this->menu_position = 1;
        $this->categorie = 'api';

    }
    function loader_sub_module()
    {

      $this->add_sub_module(
        array(
          'name' => 'Configuration',
          'call_back' => 'stripe_configuration',
          'sub_module' => 'stripe_configuration',
          'slug' => 'config'
        )
      );

      $this->add_sub_module(
        array(
          'name' => 'tools stripe',
          'sub_module' => 'tools_stripe',
          'slug' => 'tool',
          'show_in_menu' => false
        )
      );

    }
    function getter()
    {
        $this->tool->stripe_authentification();
    }
		function view_back()
		{
      $this->tool->stripe_authentification();

      if (  $this->tool->is_connected() ) {

      $this->add_module_js('subcription_stripe.js');

      $plans = $this->tool->get_plans();

      $this->convert_in_js('stripe_plans', $plans['data'] );

			$view =  $this->twig_render( 'subcription_stripe_home.html',
					array()
			);

			return $view;
      }
      else
      {
        return "stripe n'est pas encore configuré";
      }
		}
		function stripe_configuration()
		{

				$form = $this->config->generate_form();

				$view =  $this->twig_render( 'configuration_stripe.html',
						array( 'form' => $form )
				);

				return $view;

		}


}
