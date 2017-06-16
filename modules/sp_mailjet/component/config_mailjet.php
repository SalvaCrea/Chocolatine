<?php

use \salva_powa\sp_component;

class config_mailjet extends sp_component
{
        function __construct()
        {
              $this->name = 'config_mailjet';
        }

        function data_schema()
        {

          $schema = [
            "type"=> "object",
            "save"=> "simple",
            "properties"=> [
              "live_secret_key"=>  [
                "title"=> "Mailjet Live Secret Key",
                "type"=> "string"
              ],
              "live_public_key"=>  [
                "title"=> "Mailjet Live Public Key",
                "type"=> "string"
              ],
              "default_mail"=>  [
                "title"=> "The default Email sender",
                "type"=> "string"
              ],
            ],
            "required"=> ["live_public_key","live_secret_key"]
          ];

          return $schema;
        }

}
