<?php
namespace sp_framework\Modules\Home\Model;

class simple_model extends sp_framework\Pattern\Module\Model
{

  var $type = 'simple';

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
