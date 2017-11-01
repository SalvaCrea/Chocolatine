<?php

namespace sp_framework\Models;

class Simple extends \sp_framework\Pattern\Model{
    var $type = "simple";
<<<<<<< HEAD
    public function true_save(){

        $database = \sp_framework\get_service( 'database' )->database;

        if ( empty( $this->data['id'] ) ) {
            $database->insert( $this->get_table_name(), $this->data );
            $this->data['id'] = $database->id();
        }else{
            $database->update( $this->get_table_name(), $this->data,
              [
               'id' => $this->data['id']
              ] );
        }

    }
    /**
     * Return One element By Id
     * @param  int        $id the id database
     * @return array     one line of database
     */
    public function get_one( $id ){
      return $results = $database->select( $this->get_table_name(), '*',
        [
         'id' => $id
        ] )[0];
    }
    /**
     * Find in database by value
     * @param  string $collumn collum search
     * @param  mixed $value   value needle
     * @param  string $operator  can it [>] | [!] -- Documentation here : https://medoo.in/api/where
     * @return array          list of row
     */
    public function get_by( $collumn, $value, $operator = ''){
      return $results = $database->select( $this->get_table_name(), '*',
        [
         'id' . $operator => $id
        ] )[0];
    }
=======
>>>>>>> master
}
