<?php

use \salva_powa\sp_component;

class tools_mailjet extends sp_component
{
      /**
       * The futur container of the mail jet api class
       * @var object
       */
        var $mj;
        function __construct()
        {
              $this->name = 'tools_mailjet';
        }
        /**
         * Convert mail for the api mail jet
         * @param  array content adresse mail
         * @return array content adresse mail for api mail jet
         */
        function convert_mail_for_mj( $emails )
        {
            $response = array();

            foreach ( $emails as  $value) {
              // test if email is for mail jet
              if ( key_exists( 'Email' , $value) ) {
                 $response []= $value;
              }
              else
              {
                  $response []= array( 'Email' => $value );
              }

            }

            return $response;

        }
        function get_mj()
        {

              if ( empty( $this->mj ) ) {
                  $this->connect_mj();
              }

              return $this->mj;
        }
        function connect_mj()
        {
            $model = $this->father->config->get_model();

            $mj = new \Mailjet\Client(
              $model['live_public_key'],
              $model['live_secret_key']
            );

            $this->mj = $mj;

            return $mj;
        }
}
