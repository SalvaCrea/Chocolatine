<?php
namespace sp_framework\Modules\GoogleApi\Model;

class AnalyticViews extends \sp_framework\Models\Simple
{

  public function model()
  {
      return array(
          "name"=>  [
            "title"=> "The name of view",
            "type"=> "string",
          ],
          "id_view"=>  [
            "title"=> "The id google view",
            "type"=> "int"
          ],
          "number"=>  [
            "title"=> "The id google view",
            "type"=> "decimal"
          ],
          "espace"=>  [
            "title"=> "The id google view",
            "type"=> "float"
          ]
      );
  }
}
