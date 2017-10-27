<?php
/*
 * This file build the modules
 *
 * (c) Cardona Salvador <contact@salva-crea.fr>
 *
 */

namespace sp_framework;

class ModuleFactory
{
      /**
       * $module_current the module being created
       * @var stdClass
       */
      public $module_current;
      /**
       * public Container of relation manager
       * @var array
       */
      public $manager_relations = [
        "view" => [
          "folder" => 'view',
          "name" => "view"
        ],
        "form" => [
          "folder" => 'form',
          "name" => "form"
        ],
        "ajax" => [
          "folder" => 'ajax',
          "name" => "ajax"
        ],
        "model" => [
          "folder" => 'model',
          "name" => "model"
        ],
        "component" => [
          "folder" => 'component',
          "name" => "component"
        ],
      ];
      public function __construct()
      {

      }
      /**
       * build_module method use for build a module
       * @param  string $module_name  name of module
       * @param  string $path_folder the path of the folder
       * @return object              the module builded
       */
      public function build_module( string $module_name, string $path_folder, string $namespace )
      {

        /**
         *
         * Create a instance of the module
         *
         */

         $class = $namespace . "\\" . $module_name ;

         $this->module_current = new $class();

         foreach ($this->manager_relations as $key => $value) {
             $this->try_find_element( $value, $namespace ,$path_folder);
         }

        /**
         * return the module buided
         */
        return $this->module_current;

      }
      /**
       * try_find_element try find element in module
       * @param array  $manager     Manager correspond
       * @param string $namespace Name of namespace
       * @param string $path_folder Path of module
       */
      public function try_find_element( array $manager, string $namespace, string $path_folder){
            /**
             *  Find element in folder
             */
            $current_folder = $path_folder . "/" . $manager['folder'];
            /**
             * Test if folder exist
             */
            if ( !is_dir ( $current_folder ) ) { return false; }

            if ( !empty(  $list_element = scanfolder( $current_folder ) ) ) {
              /**
               *  Serach manager link of folder
               */
                if ( false !== ( $current_manager = get_manager( $manager['name'] ) ) ) {

                    $this->module_current->component = new \stdClass();

                    foreach ( $list_element as $element ) {

                      $element_name = basename($element, ".php");
                      $element_namespace = $namespace . "\\" . $manager['name'] . "\\" . $element_name;
                      /**
                       * Instanced Element if the Element if a component
                       */
                      if ( $manager['name'] == 'component' ) {
                          $this->module_current->component->$element_name = new $element_namespace();
                      }

                      $this->try_add_element(
                        $current_manager,
                        $element_namespace
                      );
                    }

                }
            }
      }
      /**
       * try_find_element try add element in module
       * @param object  $manager           manager used
       * @param string $element_namespace  namepsace element
       */
      public function try_add_element(  $manager, string $element_namespace ){
            $manager->add( $element_namespace );
      }

}
