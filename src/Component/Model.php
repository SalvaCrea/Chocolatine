<?php
namespace Chocolatine\Component;

/**
 *  The Component used for create DataBase model
 */

abstract class Model
{
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
    public function get_table_name()
    {
      $service = \Chocolatine\get_service('database');
      return $service->prefixe . $this->name;
    }
    /**
     * Return the relation
     * @return array the relation
     */
    public function get_relation()
    {
        return $this->relation();
    }
    /**
     * Function Set Data
     * @param array  Contain data
     */
    public function set_data($data)
    {
        $this->data = $data;
    }
    /**
     * Save the Data
     * @return [type] [description]
     */
    public function save()
    {

          $this->before_save();

          $this->true_save();

          $this->after_save();
    }
    /**
     * Action before save
     */
    public function before_save(){}
    /**
     * Save the data
     */
    public function true_save(){}
    /**
     * Action after save
     */
    public function after_save(){}
}
