<?php

use \salva_powa\sp_component;
use \Stripe\Stripe;

class tools_stripe extends sp_component
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
      /**
       * [Return the key of stripe]
       * @return [array] [return the key of stripe]
       */
        function get_keys()
        {
            $response = array(
              'key_public' => '',
              'key_private' => '',
            );

            $model = $this->father->config->get_model();

            if ( sp_dev() ) {
                $response = array(
                  'key_public' => $model['test_public_key'],
                  'key_private' => $model['test_secret_key'],
                );
            }
            else
            {
              $response = array(
                'key_public' => $model['live_public_key'],
                'key_private' => $model['live_secret_key'],
              );
            }

            return $response;
        }
        /**
         * [add_stripe_js add js the lib js in view]
         */
        function add_stripe_js()
        {
          wp_enqueue_script( 'stripe_lib',
            'https://js.stripe.com/v2/'
          );
        }
        /**
         * [create_form_stripe Create form by stripe ]
         * @param  [type] $args [the arguments for create a form]
         * @return [string]       [return text/html form]
         */
        function create_form_stripe( $args )
        {

          $args_default = array(
              'server_url' => '',
              'public_key' => $this->get_keys()['key_public'],
              'amount' => 0,
              'name' => get_bloginfo( 'name' ),
              'url_logo' => '/images/logo.jpg',
              'locale' => 'auto',
              'currency' => 'eur',
              'label' => 'Pay with card'
          );

          $args = array_merge($args_default, $args);

          $form = "
              <form action=\"{$args['server_url']}\" method=\"POST\">
                <script
                  src=\"https://checkout.stripe.com/checkout.js\" class=\"stripe-button\"
                  data-key=\"{$args['public_key']}\"
                  data-amount=\"{$args['amount']}\"
                  data-name=\"{$args['name']}\"
                  data-description=\"Widget\"
                  data-image=\"{$args['url_logo']}\"
                  data-locale=\"{$args['locale']}\"
                  data-currency=\"{$args['currency']}\"
                  data-label=\"{$args['label']}\">
                </script>
              </form>
              ";

          return $form;
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
        /**
         * [customer_create Create a customer by the form stripe]
         * @param  [type] $token         [The token $Post create by stripe form]
         * @param  [type] $id_plan       [The id of plan]
         * @param  [type] $customer_mail [The mail of the customer]
         * @return [type]                [Return the response stripe]
         */
        function customer_create( $token, $id_plan, $customer_mail)
        {

            $customer = \Stripe\Customer::create(
                array(
                "source" => $token,
                "plan" => $id_plan,
                "email" => $customer_mail
                )
            );

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
            'limit' => 100
          );

          $args = array_merge( $args_default, $args );

          return $plans = \Stripe\Plan::all( $args );
        }
        /**
         * [get_plan_by_id Get the plan stripe by the id ]
         * @param  [int] $id_plan [the id plan]
         * @return [object]          [return object than contain info plan]
         */
        function get_plan_by_id( $id_plan )
        {
            return $plan = \Stripe\Plan::retrieve( $id_plan );
        }
        /**
         * Create a plan for subscription user
         * @param  array  $args the argument for create plan
         * @param  int  $amount the somme for create plan
         * @return object return the object create by stripe
         */
        function create_plan(  float $amount ,  $args = array() )
        {

          $args_default = array(

            'name' => 'Subscription of ' . $amount / 100 . '€',
            'currency' => 'eur',
            "interval" => "month",

          );

          $args = array_merge( $args_default, $args );

          $plan = \Stripe\Plan::create(
            array(
              "amount" => $amount,
              "interval" => $args['interval'],
              "name" => $args['name'],
              "currency" => $args['currency'],
              "id" => "subs". $amount / 100 . 'by' . $args['interval']
            )
          );

          return $plan;
        }

}
