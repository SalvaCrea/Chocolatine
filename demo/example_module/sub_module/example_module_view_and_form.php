<?php

use \salva_powa\sp_sub_module;

class example_module_view_and_form extends sp_sub_module
{
        function __construct()
        {
              $this->name = 'example_module_view_and_form';
        }
        function data_schema()
        {

          $schema = [
            "type"=> "object",
            "save"=> "simple",
            "properties"=> [
              "email_user"=>  [
                "title"=> "Email du partenaire",
                "type"=> "string",
                "pattern" => "^\\S+@\\S+$",
              ],
              "ammount"=>  [
                "title"=> "Somme de l'abonnement",
                "type"=> "number"
              ]
            ],
            "required"=> ["test_secret_key","test_public_key","live_secret_key","live_public_key"]
          ];

          return $schema;
        }

}
