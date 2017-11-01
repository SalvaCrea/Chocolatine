<?php
namespace sp_framework\Modules\ModelTool\component;

class Update extends \sp_framework\Pattern\Module\Component
{
  public function __construct(){

  }
  public function updateDatabse(){

      $modelManager = \sp_framework\get_manager( 'model' );

      foreach ( $modelManager->container  as $key => $model_info ) {
            $this->ApplyModel( $model_info );
      }
  }
  public function ApplyModel( $model_info ){

      $database   = \sp_framework\get_service( 'database' );
<<<<<<< HEAD
      $model      = $model_info->make();
      $schema     = $model->get_model();
      $table_name = $model_info->name;
=======
      $model      = new $model_info['namespace']();
      $schema     = $model->get_model();
      $table_name = $model_info['name'];
>>>>>>> master

      if ( !$database->verifyIfTablePresent( $table_name ) ) {
          $database->createTable( $table_name );
      }

      foreach ( $schema as $column_name => $cullumn ) {

          $database->addCollumn(
            $table_name,
            $column_name,
            $cullumn['type']
          );
      }
  }

}
