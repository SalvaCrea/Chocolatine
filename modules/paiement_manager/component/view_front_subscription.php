<?php

use \salva_powa\sp_component;

class view_front_subscription extends sp_component
{
      /**
       *  The web page of user
       * @var string
       */
        var $front_url = "/requete-dabonnement/?id_request={id_request}";
        /**
         *  The id of request sucription
         * @var int
         */
          var $id_request;
          /**
           *  The request link of view
           * @var array
           */
          var $subscription_request;
        /**
         * Transform the web url in the final url
         * @param  int    $id_request [the id of request subscription]
         * @return [string]             [return the url final]
         */
        function get_front_url( int $id_request )
        {
            $front_url = get_option( 'siteurl' ) . str_replace( '{id_request}', $id_request, $this->front_url );
            return $front_url;
        }
        /**
         * [front_view description]
         * @return [type] [description]
         */
        function front_view()
        {
          $this->id_request = $_GET['id_request'];

          // redirection if the id request is empty
          if ( empty( $this->id_request ) )
                sp_redirection_js( '/' );

          $this->subscription_request = $this->father->rq_subcription->get_one( $this->id_request );

          if ( !empty( $_POST['stripeToken'] ) ) {
              return $this->validate_and_create();
          }
          else
          {
              return $this->front_form_paiement();
          }

        }
        /**
         * [front_form_paiement Generate a form stripe]
         * @return [string] [the form contain]
         */
        function front_form_paiement()
        {
            $stripe = sp_get_module('sp_stripe');

            $view = $this->father->twig_render( 'front/form.html',
                array(
                  'client_request' => $this->subscription_request
                )
            );

            $form_stripe = $stripe->tool->create_form_stripe(
                array(
                    'amount' => $this->subscription_request['amount'] * 100,
                    'label' => 'Payez avec votre carte',
                )
             );

            $view .= $form_stripe;

            return $view;

        }
        /**
         * [validate_and_create valide the form created]
         * @return [string] [Return the string back front_paiment_validated]
         */
        function validate_and_create()
        {
          $stripe = sp_get_module('sp_stripe');
          $post_manager = sp_get_module('sp_wp_post');

          $token = $_POST['stripeToken'];

          $id_plan = $this->subscription_request['id_plan'];
          $email_customer = $this->subscription_request['email'];

          $customer = $stripe->tool->customer_create( $token, $id_plan, $email_customer);

          $post_manager->post->update_meta( $this->id_request, 'id_customer',  $customer->id );

          $this->send_mail_for_thank( $this->id_request );

          return $this->front_paiment_validated();
        }
        /**
         * [send_mail_request_subscription send mail link of request of subcription]
         * @param  [int] $amount [ammount of the plan]
         * @param  [string] $name   [the name of client]
         * @return [boolean]         [return true of a mail if sended]
         */
        function send_mail_for_thank( $id_request_subscription )
        {
          $sp_mail = sp_get_module('mailjet_api');

          $post = $this->father->rq_subcription->get_one( $id_request_subscription );

          $sp_mail->send(

            array(
            'FromName' => "Sophie Tripconnexion",

            'Subject' => $post['name'] . ' - Demande de prélévement acceptée',

            'Recipients' => [

                "sophie@tripconnexion.com",
                $post['email_user']

              ]

            ),
            // the mail template mailjet
            '30151',
            // var of the data mail template
            [
                'price' => $post['amount'],
                'nameContact' => $post['name'],
                'contactMainFirstName' => $post['contact_main_first_name'],
                'toDayDate' => date('d')
            ]
          );

        }
        /**
         * [front_paiment_validated Return the thanked message]
         * @return [string] [the message of thanked]
         */
        function front_paiment_validated()
        {
          $view = $this->father->twig_render( 'front/after_form.html', array() );

          return $view;
        }

}
