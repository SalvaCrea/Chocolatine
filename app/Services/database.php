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
  /**
   * Prefixe use for name Table
   * @var string
   */
  public $prefixe = '';

  public function __construct(){

  }
  /**
   * [init description]
   * @return [type] [description]
   */
  public function init(){

      $info_datase = \sp_framework\get_configuration( 'database' );

      $this->database = new Medoo( $info_datase );

      $this->prefixe = $info_datase["prefixe"];
  }
  public function getter(){
<<<<<<< HEAD

=======
>>>>>>> master
      if ( empty( $this->database ) ) {
        $this->init();
      }
  }
  /**
   * Verify if table id present
   * @param  string $table_name Name of table
   * @return boolean             True if present or false
   */
  public function verifyIfTablePresent( $table_name ){

      $table_name = $this->prefixe . $table_name;

      $result = $this->database->query( "SHOW TABLES LIKE '".$table_name."'" )->fetchAll();

      if ( empty( $result ) ) {
        return false;
      }
      else{
        return true;
      }

  }
/**
 * Create Table in database
 * @param  string $table_name Name of table
 */
<<<<<<< HEAD
  public function createTable( $table_name ){
=======
  public function createTable( string $table_name ){
>>>>>>> master

        $table_name = $this->prefixe . $table_name;

        $result = $this->database->query(
          "CREATE TABLE `{$table_name}` (
          `id` INT NOT NULL AUTO_INCREMENT,
          PRIMARY KEY (`id`))"
         )->fetchAll();

  }
  /**
 * [addCollumn description]
 * @param string $table_name  Name of table
 * @param string $column_name Name of Collum
 * @param string $type        Type of Collum can VARCHAR(45) | LONGTEXT | TINYINT | INT | DECIMAL | FLOAT
 * @param string $nullabe     If collum is null
 * @param array  $args        All supp arguments
 */

<<<<<<< HEAD
  public function addCollumn( $table_name, $column_name, $type, $nullabe = 'NULL', $args = [] ){
=======
  public function addCollumn( string $table_name, string $column_name, string $type, string $nullabe = 'NULL', array $args = [] ){
>>>>>>> master

        $table_name = $this->prefixe . $table_name;

        $type = strtoupper($type);

        if ( $type == 'STRING' ) {
            $curent_type = "LONGTEXT";
        }
        else{
            $curent_type = $type;
        }

        $result = $this->database->query(
          "ALTER TABLE $table_name ADD $column_name $curent_type $nullabe"
         )->fetchAll();
<<<<<<< HEAD

=======
         
>>>>>>> master
  }
}
