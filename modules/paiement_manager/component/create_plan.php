<?php

use \salva_powa\sp_component;
use \Stripe\Stripe;

class create_plan extends sp_component
{

  function data_schema()
  {

    $schema = [
      "type"=> "object",
      "save"=> "self",
      "properties"=> [
          "amount"=>  [
              "title"=> "Quel prix désirez-vous pour cet abonnement",
              "type"=> "number"
            ]
      ],
      "required"=> ["amount"]
    ];

    return $schema;
  }
  function save_form( $args )
  {

    $sp_stripe = sp_get_module('sp_stripe');

    $sp_stripe->tool->create_plan(  $args['amount'] * 100 );

    return true;
  }

}
