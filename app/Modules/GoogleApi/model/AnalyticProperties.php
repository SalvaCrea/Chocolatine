<?php
namespace sp_framework\Modules\GoogleApi\Model;

class AnalyticProperties extends \sp_framework\Models\Simple
{

  public function model()
  {
      return array(

          "idProperty"=>  [
            "title"=> "The id Property",
            "type"=> "string"
          ],
          "accountId"=>  [
            "title"=> "The id Account",
            "type"=> "string"
          ],
          "name"=>  [
            "title"=> "The name of view",
            "type"=> "string",
          ],
          "url"=>  [
            "title"=> "The Url of website",
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
