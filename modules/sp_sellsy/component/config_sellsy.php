<?php

use \salva_powa\sp_sub_module;

class config_sellsy extends sp_sub_module
{
        function __construct()
        {
              $this->name = 'config_sellsy';
        }

        function data_schema()
        {

          $schema = [
            "type"=> "object",
            "save"=> "simple",
            "properties"=> [
              "consumer_token"=>  [
                "title"=> "Sellsy consumer token",
                "type"=> "string"
              ],
              "consumer_secret"=>  [
                "title"=> "Sellsy consumer secret",
                "type"=> "string"
              ],
              "utilisateur_token"=>  [
                "title"=> "Sellsy utilisateur token",
                "type"=> "string"
              ],
              "utilisateur_secret"=>  [
                "title"=> "Sellsy utilisateur secret",
                "type"=> "string"
              ]
            ],
            "required"=> ["live_public_key","live_secret_key"]
          ];

          return $schema;
        }

}
