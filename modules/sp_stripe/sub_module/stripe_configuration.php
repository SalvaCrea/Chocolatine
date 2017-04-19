<?php

use \salva_powa\sp_sub_module;

class stripe_configuration extends sp_sub_module
{
        function __construct()
        {
              $this->name = 'stripeConfiguration';
        }

        function data_schema()
        {

          $schema = [
            "type"=> "object",
            "save"=> "simple",
            "properties"=> [
              "test_secret_key"=>  [
                "title"=> "Stripe Test Secret Key",
                "type"=> "string"
              ],
              "test_public_key"=>  [
                "title"=> "Stripe Test Public Key",
                "type"=> "string"
              ],
              "live_secret_key"=>  [
                "title"=> "Stripe Live Secret Key",
                "type"=> "string"
              ],
              "live_public_key"=>  [
                "title"=> "Stripe Live Public Key",
                "type"=> "string"
              ],
              "object_mail"=>  [
                "title"=> "Object du mail",
                "type"=> "string"
              ],
            ],
            "required"=> ["name","email","comment"]
          ];

          return $schema;
        }

}
