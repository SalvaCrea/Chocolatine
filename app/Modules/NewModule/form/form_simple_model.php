<?php
namespace sp_framework\Modules\NewModule;

use \sp_framework\sp_form;

class form_simple_model extends sp_form
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
