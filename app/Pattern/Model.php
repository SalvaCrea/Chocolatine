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
    public $type;
    /**
     *  Array content the dataSchmea
     * @return array Schema database
     */
    public function model(){
        // Example model
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
    public function relation(){
      // Example Relation
      // return [
      //   "relation" => [
      //     "table_1.id > 1/n > table2.id_table_1",
      //     "table_1.id > 1/* > table2.id_table_1",
      // ]
    }
    public function get_model(){
        return $this->model();
    }
    public function get_relation(){
        return $this->relation();
    }
}
