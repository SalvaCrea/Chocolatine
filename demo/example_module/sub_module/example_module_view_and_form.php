<?php

use \salva_powa\sp_sub_module;

class example_module_view_and_form extends sp_sub_module
{
        function __construct()
        {
              $this->name = 'example_module_view_and_form';
        }
        /**********************************************************************
        *
        *  The model link of the sub module
        *
        ***********************************************************************/
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
        /**********************************************************************
        *
        *  The form link of the sub module
        *
        ***********************************************************************/
        function data_form()
        {

          return [
            "email_user", "name",
            [
              "key" => "amount",
              "type" => "select",
              "titleMap" => [
                ['name' => "val1", 'value' => "1",]
              ]
            ],
            [
              "type" => "submit",
              "title" => "Envoyer une demande",
              "style" => "btn-info"
            ]
          ];

        }

}
