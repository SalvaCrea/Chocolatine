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
     * The currents datas
     * @var array
     */
    public $data;
    /**
     *  Array content the dataSchmea
     * @return array Schema database
     *
     * Example model
     * return [
     *         [
     *           "name" => "title",
     *           "type" => "text",
     *           "required" => true
     *         ],
     *         [
     *           "name" => "title",
     *           "type" => "text",
     *           "required" => true
     *         ],
     *       ];
     *
     */
    public function model(){}
    /**
     * Return relation under table
     * @return array return
     *
     * Example Relation
     * return [
     *   "relation" => [
     *     "table_1.id > 1/n > table2.id_table_1",
     *     "table_1.id > 1/* > table2.id_table_1",
     * ]
     *
     */
    public function relation(){}
    /**
     * Return the model
     * @return array the model
     */
    public function get_model(){
        return $this->model();
    }
    /**
     * Return the relation
     * @return array the relation
     */
    public function get_relation(){
        return $this->relation();
    }
    /**
     * Save the Data
     * @return [type] [description]
     */
    public function save(){
        $data = $this->data;
    }
}
