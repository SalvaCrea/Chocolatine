<?php
namespace sp_framework\Pattern;

/**
 *  The pattern used for create DataBase model
 */

class Model{
    /**
     * The type of model
     * classic | metapost | simple
     * @var string
     */
    var public $type;
    /**
     *  Array content the dataSchmea
     * @return array Schema database
     */
    public function get_model(){

        // return [
        //         [
        //           "name" => "title",
        //           "type" => "text",
        //           "required" => true
        //         ],
        //         [
        //           "name" => "title",
        //           "type" => "text",
        //           "required" => true
        //         ],
        //       ];

    }
    /**
     * Return relation under table
     * @return array return
     */
    public function get_relation(){
      // Example Relation
      // return [
      //   "relation" => [
      //     "table_1.id > 1/n > table2.id_table_1",
      //     "table_1.id > 1/* > table2.id_table_1",
      // ]
    }
}
