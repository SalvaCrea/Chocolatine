<?php

use \salva_powa\sp_sub_module;

class tools_sellsy extends sp_sub_module
{
    /**
  	 * The boolean if sellsy is connected or not
  	 * @var boolean
  	 */
      var $sellesyconnected = false;

      /**
       * Function for connected Sellsy and the module
       * @return [type] [description]
       */
      function sellsyConnect()
      {

          $model = $this->father->config->get_model();
        
          if ( !empty( $model ) && !$this->sellesyconnected ) {

            sellsyConnect_curl::$oauth_access_token = $model['utilisateur_token'];
            sellsyConnect_curl::$oauth_access_token_secret = $model['utilisateur_secret'];
            sellsyConnect_curl::$oauth_consumer_key = $model['consumer_token'];
            sellsyConnect_curl::$oauth_consumer_secret = $model['consumer_secret'];

            if ( $this->test_connect_sellsy() )
               $this->sellesyconnected = true;

          }

          return $this->sellesyconnected;
      }
      /**
       * Test the connexion under the module and stripe
       * @return boolean return true if the connection is good
       */
      function test_connect_sellsy()
      {

        $client = $this->find_client();

        if ( !empty( $client->response->result ) ) {
            return true;
        }
        else
        {
          return false;
        }

      }
      /**
       * This function the motor search of selldy
       * @param  array  $args the argument of research
       * @return [type]       the result
       */
      function find_client( $args = array() )
      {

        $args_default = array(
            'email'         => '',
        );

        $args = array_merge( $args_default, $args );

        $request = array(
            'method' => 'Client.getList',
            'params' => array(

                'search' => $args

            )
        );

        $response = sellsyConnect_curl::load()->requestApi($request);

        return $response;

      }

}
