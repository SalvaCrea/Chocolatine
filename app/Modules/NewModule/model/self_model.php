<?php
namespace sp_framework\Modules\NewModule;

use \sp_framework\sp_model;

class self_model extends sp_model
{

  var $type = 'self';

  public function model()
  {
      return $model = array(
          "email"=>  [
            "title"=> "Email of user",
            "type"=> "string",
            "pattern" => "^\\S+@\\S+$",
          ],
          "name"=>  [
            "title"=> "the name of enterprise",
            "type"=> "string"
          ]
      );
  }
}
