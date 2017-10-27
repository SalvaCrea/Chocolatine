<?php

use \salva_powa\sp_component;
use \Stripe\Stripe;

class tools_subscription extends sp_component
{

        var $tools_subscription_connected = false;

        function __construct()
        {
              $this->name = 'tools_subscription';
        }

        /**********************************************************************
        *
        *  Method Around the Stripe and the of subscription
        *
        ***********************************************************************/
        /**
         * [verify_customer_on_stripe description this function get the subscription
         * by the api stripe and append in the module paiement manage]
         * @return [ array || boolean] [True if a good processing or false if bad processing]
         */
        function verify_customer_on_stripe()
        {
            $array_return = array(
                // the number of subscription added
                'subs_added' => 0,
                // requete for add
                'req_subs_added' => 0,
                // subscription updated
                'subs_updapted' => 0,
                // subscciption try updated
                'req_subs_updapted' => 0,
            );

            $stripe = sp_get_module('sp_stripe');
            // compoment  rq_subcription
            $com_rq_subcription =  $this->father->rq_subcription;
            // get the first 100 subcrition
            $subscription = $stripe->tool->get_subscriptions();

            foreach ( $subscription->data as $key => $subsciption ) {

              $res = (array) $com_rq_subcription->get_customer_by_id( $subsciption->customer );

              if ( !$res ) {
                 $array_return['req_added']++;

                 $res_add = $this->add_subscription_by_data_stripe( $subsciption );
                 if ( $res_add ) {
                   $array_return['subs_added']++;
                 }
              }
              else
              {
                  $array_return['req_subs_updapted']++;

                  $res_add = $this->add_subscription_by_data_stripe(  $subsciption, $res['ID'] );

                  if ( $res_add ) {
                    $array_return['subs_updapted']++;
                  }

              }


            }

            return $array_return;

        }
        /**
         * [ add_customer_by_data_stripe Get the customer by the api Stripe
         * and append in the module paiement manager,
         *  If id_post is present then is updated or not added
         *  ]
         * @param [ object ] $subscription_stripe [ one subscription stripe ]
         * @param [ int ] $id_post [ the id of the module, manager]
         * @return [ boolean | int ] return false for the bad processing or the id of the  occurence
         */
        function add_subscription_by_data_stripe( $subscription_stripe, $id_post = false )
        {
            $stripe = sp_get_module('sp_stripe');
            $sellsy_api = sp_get_module('sellsy_api');
            // compoment  rq_subcription
            $com_rq_subcription =  $this->father->rq_subcription;

            $customer = $stripe->tool->get_customer_by_id( $subscription_stripe->customer );
            $plan = $subscription_stripe->plan;
            $client = reset (
            $sellsy_api->tool->find_client( array('email' => $customer->email ) )
            ->response
            ->result
            );

            $args_add = array(
              "email_user" => $customer->email,
              "id_plan" => $plan->id,
              "amount" => $plan->amount,
              "id_subscription" => $subscription_stripe->id,
              "id_customer" => $customer->id,
              "name" => $client->name,
              "subscription_in_action" => true
            );

            if ( !empty( $id_post ) ) {
              $args_add['ID'] = $id_post;
            }

            return $com_rq_subcription->add( $args_add );
        }

}
