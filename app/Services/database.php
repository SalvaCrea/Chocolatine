<?php

namespace sp_framework\Services;

use Medoo\Medoo;

class DataBase extends \sp_framework\Pattern\Service{
  /**
   * Container Instance meedoo
   * @var object
   */
  static $database;
  public function __construct(){

  }
  /**
   * [init description]
   * @return [type] [description]
   */
  public function init(){
    self::$database = new Medoo( sp_framework\get_configuration( 'database' ) );
  }
}
