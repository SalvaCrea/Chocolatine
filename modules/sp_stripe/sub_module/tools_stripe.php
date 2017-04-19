<?php

use \salva_powa\sp_sub_module;
use \Stripe\Stripe;

class tools_stripe extends sp_sub_module
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

            if ( !empty(  $model  ) ) {

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
        /**
         * say if stripe is connected or not
         * @return boolean
         */
        function is_connected()
        {
            if ( !$this->stripe_connected ) { return false ;}
            else { return true; }
        }
        /**
         * Return the plans of stripe
         * @return array the plans stripe
         */
        function get_plans()
        {
          return $plan = \Stripe\Plan::all(array('limit'=>100));
        }
        function get_subscriptions()
        {

          $subscription = \Stripe\Subscription::all(array('limit'=>100));

          foreach ($subscription['data'] as $key => $value) {

            // $subscription['data'][$key]['email'] = $this->get_customer_by_id( $value['customer'] )['email'];

          }
          return $subscription;
        }
        /**
         * Return the customer by id stripe
         * @param  string the id customer of api strip
         * @return mixed object if find or boolean false is not false
         */
        function get_customer_by_id( $id_customer )
        {
              $customer = \Stripe\Customer::retrieve( $id_customer );

              return $customer;
        }

}
