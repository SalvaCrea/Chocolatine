<?php

use \salva_powa\sp_sub_module;
use \Stripe\Stripe;

class tools_example extends sp_sub_module
{

        var $tools_example_connected = false;

        function __construct()
        {
              $this->name = 'tools_example';
        }

        /**********************************************************************
        *
        *  Method Around the connection
        *
        ***********************************************************************/

        /**
         * Connection stripe
         * @return [type] [description]
         */
        function example_authentification()
        {
            return $this->stripe_connected;
        }
        /**
         * Test the connexion under the module and stripe
         * @return boolean return true if the connection is good
         */
        function test_connect_tools_example()
        {

        }
        /**
         * say if stripe is connected or not
         * @return boolean
         */
        function is_connected()
        {

        }


}
