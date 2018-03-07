<?php

use Chocolatine\Functions;

namespace Chocolatine\Modules\ModelTool\component;

class Update extends \Chocolatine\Pattern\Module\Component
{
  public function __construct(){

  }
  public function updateDatabse(){

      $modelManager = get_manager('model');

      foreach ($modelManager->container  as $key => $model_info) {
            $this->ApplyModel($model_info);
      }
  }
  public function ApplyModel($model_info){

      $database   = \Chocolatine\get_service('database');
      $model      = $model_info->make();
      $schema     = $model->get_model();
      $table_name = $model_info->name;

      if (!$database->verifyIfTablePresent($table_name)) {
          $database->createTable($table_name);
      }

      foreach ($schema as $column_name => $cullumn) {

          $database->addCollumn(
            $table_name,
            $column_name,
            $cullumn['type']
         );
      }
  }

}
