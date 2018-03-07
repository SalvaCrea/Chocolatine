<?php

namespace Chocolatine\Services;

use Chocolatine\Component\Service;
use Medoo\Medoo;

use Chocolatine\Helper;

class Database extends Service
{
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
    public function init()
    {
        $info_datase = Helper::get_configuration( 'database' );
        if ( !empty( $info_datase['database_name'] ) ) {
            $this->database = new Medoo( $info_datase );
            $this->prefixe = $info_datase["prefixe"];
        }
    }
    public function getter(){

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
    public function createTable( $table_name ){

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

    public function addCollumn( $table_name, $column_name, $type, $nullabe = 'NULL', $args = [] ){

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

    }
}
