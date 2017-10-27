<?php

use \salva_powa\sp_component;

class create_request_subcription extends sp_component
{

        function __construct()
        {
              $this->name = 'create_request_subcription';
        }
        /**
         * [get_all subscription request]
         * @return [array] [return list of subscription]
         */
        function get_all()
        {

          $post_manager = sp_get_module('sp_wp_post');

          $args = array(
              'post_type' => $this->rq_subcription->data_schema()['post_type']
          );

          $list_request_subscription = $post_manager->find_post( $args );

          return $list_request_subscription;

        }
        /**
         * [get_one Request of subscription]
         * @param  [int] $post_id [ the id post of resquest ]
         * @return [object]          [ contain the information link one request ]
         */
        function get_one( $id_request_subscription )
        {
            $sellsy_api = sp_get_module('sellsy_api');
            $post_manager = sp_get_module('sp_wp_post');
            $stripe = sp_get_module('sp_stripe');

            $subscription = $post_manager->get_post_full( $id_request_subscription, true );

            $client = (array) $sellsy_api->tool->find_client(
              array(
                'email' => $subscription['email_user']
              )
            )->response
            ->result;

            foreach ( $client as $value) { $client = (array) $value; }

            $subscription = array_merge( $subscription,  $client);

            $subscription['main_contact'] = (array) reset (  $subscription['contacts'] );

            $subscription['front_url']  = $this->father->view_front->get_front_url( $id_request_subscription );

            $main_contact = array(
                'contact_main_first_name' => $subscription['main_contact']['forename'],
                'contact_main_name' => $subscription['main_contact']['name']
            );

            $subscription = $main_contact + $subscription;

            if ( !empty( $subscription['id_customer'] ) ) {
              $subscription['data_stripe'] = (array) $stripe->tool->get_customer_by_id( $subscription['id_customer'] );
            }
            return $subscription;
        }
        /**
         * [get_customer_by_id Return the request of subscrition by id customer]
         * @param  [string] $id_customer [the id of customer of stripe]
         * @return [False | array]              [return False or request of subscription]
         */
        function get_customer_by_id( $id_customer )
        {
              $schema = $this->data_schema();
              $post_manager = sp_get_module('sp_wp_post');

              $post = $post_manager->tool->find_post(
                array(
                  'post_type' => $schema['post_type'],
                  'meta_key'     => 'id_customer',
                	'meta_value'   => $id_customer,
                	'meta_compare' => '=',
                )
              );

              if ( $post->post_count > 0 ) {
                  return $this->get_one( $post->posts[0]->ID );
              }
              return false;
        }
        /**
         * [add request of subcription request]
         * @param [type] $data [description]
         * @return [boolean]         [return true of a mail if sended]
         */
        function add( $data )
        {
          $data = (array) $data;

          $post_manager = sp_get_module('sp_wp_post');
          $stripe = sp_get_module('sp_stripe');

          $schema = $this->data_schema();

          $plan = $stripe->tool->get_plan_by_id( $data['id_plan'] );

          $data['amount'] = $plan->amount / 100;

          $data['post_type'] = $schema['post_type'];

          $id_request_subscription = $post_manager->post->add( $data );

          return $id_request_subscription;
        }
        /**
         * [send_mail_request_subscription send mail link of request of subcription]
         * @param  [int] $amount [ammount of the plan]
         * @return [boolean]         [return true of a mail if sended]
         */
        function send_mail_request_subscription( $id_request_subscription )
        {
          $sp_mail = sp_get_module('mailjet_api');

          $post = $this->get_one( $id_request_subscription );

          $mail_var = array(
            'contactMainFirstName' => $post['contact_main_first_name'],
            'price' => $post['amount'],
            'url' => $post['front_url']
          );

          $mail_info = $sp_mail->send(

            array(
            'FromName' => "Sophie Tripconnexion",

            'Subject' => $post['name'] ." - Demande de validation d'abonnement par prélévement",

            'Recipients' => [

                "sophie@tripconnexion.com",
                $post['email_user']

              ]

            ),
            // the mail template mailjet
            '147282',
            // var of the data mail template
            $mail_var
          );

        }
        /**********************************************************************
        *
        *  The Save method
        *
        ***********************************************************************/
        function save_form( $data )
        {

            $id_request_subscription = $this->add( $data );

            if ( !empty( $id_request_subscription ) )  {
                $this->send_mail_request_subscription( $id_request_subscription );
            }

            return $id_request_subscription;

        }
        /**********************************************************************
        *
        *  The model link of the sub module
        *
        ***********************************************************************/
        function data_schema()
        {

          $schema = [
            "type"=> "object",
            "save"=> "self",
            "post_type" => "subcription_stripe",
            "properties"=> [
              "email_user"=>  [
                "title"=> "Email du partenaire",
                "type"=> "string",
                "pattern" => "^\\S+@\\S+$",
              ],
              "name"=>  [
                "title"=> "Nom de l'entreprise du partenaire ( Information by Sellsy )",
                "type"=> "string"
              ],
              "contact_main_first_name"=>  [
                "title"=> "Prénom du contact partenaire ( Information by Sellsy )",
                "type"=> "string"
              ],
              "contact_main_name"=>  [
                "title"=> "Nom du contact partenaire ( Information by Sellsy )",
                "type"=> "string"
              ],
              "id_plan" =>
              [
                "title"=> "The id of plans stripe",
                "type"=> "string"
              ],
              "amount"=>  [
                "title"=> "Somme de l'abonnement",
                "type"=> "number"
              ],
              "id_customer" => [
                "title" => "the id of stripe customer",
                "type" => "string",
              ],
              "id_subscription" =>
              [
                "title" => "the id of the stripe subscription",
                "type" => "string",
              ],
              "subscription_in_action" => [
                "title" => "The subscription is valid and is action on stripe",
                "type" => "boolean",
              ],
            ],
            "required"=> ["amount", "email_user", "name"]
          ];

          return $schema;
        }
        /**********************************************************************
        *
        *  The form link of the sub module
        *
        ***********************************************************************/
        function data_form()
        {
          $stripe = sp_get_module('sp_stripe');
          $plans = $stripe->tool->get_plans();

          $select_amount = array();

          foreach ($plans['data'] as $value) {

            $select_amount []= array(
              'name' =>$value['amount'] / 100,
              'value' =>$value['id'],
            );

          }

          return [
            "email_user", "name",
            [
              "key" => "id_plan",
              "type" => "select",
              "title" => "Abonnement",
              "titleMap" => $select_amount
            ],
            [
              "type" => "submit",
              "title" => "Envoyer une demande",
              "style" => "btn-info"
            ]
          ];

        }
}
