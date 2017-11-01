<?php

namespace sp_framework\Services;

use Medoo\Medoo;

class DataBase extends \sp_framework\Pattern\Service{
  /**
   * Container Instance meedoo
   * @var object
   */
  public $database;

  public $name = 'form';
  /**
   * Prefixe use for name Table
   * @var string
   */
  public $prefixe = '';

  public function __construct(){

  }
  /**
   * [generate_form description]
   * @param  string $model Name of Model
   * @param  string $form  Name of Form
   * @return string        form html
   */
  public function generate_form( $model, $form = '' ){

      $model = \sp_framework\get_model( $model, true );
      if ( !empty( $form ) ) {
          $form = \sp_framework\get_form( $model, true );
      }
  }
}
