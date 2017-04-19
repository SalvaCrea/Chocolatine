<?php

use \salva_powa\sp_sub_module;

class tools_sellsy extends sp_sub_module
{
    /**
  	 * The boolean if sellsy is connected or not
  	 * @var boolean
  	 */
      var $sellesyconnected = false;

      public function __call($method,$args)
      {
          sp_dump($method);
          sp_dump($args);
      }

      function sellsyConnect()
      {
          $model = $this->father->config->get_model();
          if ( !empty( $model ) && !$this->sellesyconnected ) {

            sellsyConnect_curl::$oauth_access_token = $model['utilisateur_token'];
            sellsyConnect_curl::$oauth_access_token_secret = $model['utilisateur_secret'];
            sellsyConnect_curl::$oauth_consumer_key = $model['consumer_token'];
            sellsyConnect_curl::$oauth_consumer_secret = $model['consumer_secret'];

            $this->sellesyconnected = true;
          }
          else
          {
            $this->sellesyconnected = false;
          }

          return $this->sellesyconnected;
      }
      function find_client( $args = array() )
      {
        $this->sellsyConnect();

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
