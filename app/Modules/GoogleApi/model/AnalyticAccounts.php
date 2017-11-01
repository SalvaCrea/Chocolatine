<?php
namespace sp_framework\Modules\GoogleApi\Model;

class AnalyticAccounts extends \sp_framework\Models\Simple
{

  public function model()
  {
      return array(

          "idAccount"=>  [
            "title"=> "The id Account",
            "type"=> "int"
          ],
          "name"=>  [
            "title"=> "The name of view",
            "type"=> "string",
          ],
          "created"=>  [
            "title"=> "Date Created",
            "type"=> "date"
          ],
          "updated"=>  [
            "title"=> "Date Created",
            "type"=> "date"
          ]
      );
  }
}
