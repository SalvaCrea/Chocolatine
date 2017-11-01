<?php

namespace sp_framework\Modules\GoogleApi\Model;

class GoogleSettings extends \sp_framework\Models\Simple
{

  public function model()
  {
      return array(
          "id_client"=>  [
            "title"=> "The id client",
            "type"=> "string",
          ],
          "secret_key"=>  [
            "title"=> "The secret key",
            "type"=> "string"
          ],
          "application_name"=>  [
            "title"=> "Application Name",
            "type"=> "string"
          ],
          "developer_key"=>  [
            "title"=> "The developer Key",
            "type"=> "string"
          ],
          "redirect_uri"=>  [
            "title"=> "The Url for redirection",
            "type"=> "string"
          ]
      );
  }
}
