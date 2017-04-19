<?php

use \salva_powa\sp_sub_module;
use \Stripe\Stripe;

class subcription_stripe_tools extends sp_sub_module
{

        var $stripe_connected = false;

        function __construct()
        {
              $this->name = 'stripeTools';
        }
        /**
         * Connection MailJet
         * @return [type] [description]
         */
        function stripe_authentification()
        {
          $model = $this->father->config->get_model();

            if ( !empty( $model  ) ) {

                if ( sp_dev() ) {
                  $key = $model['test_secret_key'];
                }
                else {
                  $key = $model['live_secret_key'];
                }

                $stripe = \Stripe\Stripe::setApiKey( $key );
                $this->stripe_connected = true;
            }


        }
        function test_connected()
        {
          if ( !$this->stripe_connected )
              $this->stripe_authentification();
        }
        function get_plans()
        {
          $this->test_connected();
          return $plan = \Stripe\Plan::all(array('limit'=>100));
        }
        function get_subscriptions()
        {
          $this->test_connected();
          $subscription = \Stripe\Subscription::all(array('limit'=>100));

          foreach ($subscription['data'] as $key => $value) {

            $subscription['data'][$key]['email'] = \Stripe\Customer::retrieve( $value['customer'] )['email'];

          }
          return $subscription;
        }

}
