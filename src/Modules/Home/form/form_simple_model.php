<?php
namespace Chocolatine\Modules\Home\Form;

class form_simple_model extends Chocolatine\Pattern\Module\Form
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
