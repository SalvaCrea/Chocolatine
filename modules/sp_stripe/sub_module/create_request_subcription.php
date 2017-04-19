<?php

use \salva_powa\sp_sub_module;

class create_request_subcription extends sp_sub_module
{
        function __construct()
        {
              $this->name = 'create_request_subcription';
        }
        function data_schema()
        {

          $schema = [
            "type"=> "object",
            "save"=> "simple",
            "properties"=> [
              "test_secret_key"=>  [
                "title"=> "Email User",
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
            "required"=> ["test_secret_key","test_public_key","live_secret_key","live_public_key"]
          ];

          return $schema;
        }

}
