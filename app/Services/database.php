<?php

namespace sp_framework\Services;

use Medoo\Medoo;

class DataBase extends \sp_framework\Pattern\Service{
  /**
   * Container Instance meedoo
   * @var object
   */
  public $database;

  public $name = 'database';

  public function __construct(){

  }
  /**
   * [init description]
   * @return [type] [description]
   */
  public function init(){
      $this->database = new Medoo( sp_framework\get_configuration( 'database' ) );
  }
  public function getter(){
      if ( !empty( $this->database ) ) {
        $this->init();
      }
  }
}
