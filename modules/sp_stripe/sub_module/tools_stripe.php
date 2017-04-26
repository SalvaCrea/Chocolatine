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

        /********************************************************************
        *
        *  Method Around the connection 
        *
        **********************************************************************/

        /**
         * Connection stripe
         * @return [type] [description]
         */
        function stripe_authentification()
        {

          $model = $this->father->config->get_model();

            if ( !empty(  $model  ) && !$this->stripe_connected ) {

                if ( sp_dev() ) {
                  $key = $model['test_secret_key'];
                }
                else {
                  $key = $model['live_secret_key'];
                }
                /**
                 * identification for api stripe
                 */
                \Stripe\Stripe::setApiKey( $key );
                /**
                 *  test the connection
                 */
                if ( $this->test_connect_stripe() ) {
                    $this->stripe_connected = true;
                }

            }

            return $this->stripe_connected;
        }
        /**
         * Test the connexion under the module and stripe
         * @return boolean return true if the connection is good
         */
        function test_connect_stripe()
        {

          try {
              $this->get_plans( array( 'limit' => '1' ) );
              return true;
          } catch (Exception $e) {
              sp_dump( $e->getMessage() );
              return false;
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


        /********************************************************************
        *
        *  Method Around the subscription
        *
        **********************************************************************/


        /**
         * The list of subcription stripe
         * @param  array  $args the arguments of search
         * @return array contain the subscription
         */
        function get_subscriptions( $args = array() )
        {

          $args_default = array(
            'limit' => 50
          );

          $args = array_merge( $args_default, $args );

          $subscription = \Stripe\Subscription::all( $args );

          return $subscription;

        }

        /********************************************************************
        *
        *  Method Around the customer
        *
        **********************************************************************/

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

        /********************************************************************
        *
        *  Method Around the plans
        *
        **********************************************************************/

        /**
         * Return the plans of stripe
         * @return array the plans stripe
         */
        function get_plans( $args = array() )
        {

          $args_default = array(
            'limit' => 50
          );

          $args = array_merge( $args_default, $args );

          return $plan = \Stripe\Plan::all( $args );
        }
        /**
         * Create a plan for subscription user
         * @param  array  $args the argument for create plan
         * @param  int  $ammount the somme for create plan
         * @return object return the object create by stripe
         */
        function create_plan(  float $ammount ,  $args = array() )
        {

          $args_default = array(

            'name' => 'Subcription of ' . $ammount . '€',
            'currency' => 'eur',
            "interval" => "month",

          );

          $args = array_merge( $args_default, $args );

          $plan = \Stripe\Plan::create(array(
            "amount" => $ammount * 100,
            "interval" => $args['interval'],
            "name" => $args['name'],
            "currency" => $args['currency'],
            "id" => "abo".$ammount )
          );

          return $plan;
        }

}
