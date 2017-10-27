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
<<<<<<< HEAD
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
=======

      public function __construct()
      {
          $this->searchModule();
      }
      /**
       * [build_module method use for build a module]
       * @param  [string] $path_folder [the path of the folder]
       * @return [object]              [the module builded]
       */
      public function build_module( $path_folder )
      {

        $json_file = file_get_contents(
          $path_folder . '/' . 'module.json'
        );

        // require the main file of module
        require $path_folder . '/' . 'module.php';

        // try for decode the json of the module
        try {
          $this->module_info = json_decode(
              $json_file
          );
        } catch (Exception $e) {
          echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

        // use the slug like namespace if the namespace is empty
        if ( empty( $this->module_info->namespace ))
              $this->module_info->namespace = $this->module_info->slug;

        /**
         *
         * [Create a instance of the module]
         *
         */
        $name_class = "\\{$this->module_info->namespace}\\{$this->module_info->namespace}";
        $this->module_current = new $name_class();

        $this->module_current->name = $this->module_info->name;
        $this->module_current->namespace = $this->module_info->namespace;
        $this->module_current->slug = $this->module_info->slug;

        // stock data of json in the module
        $this->module_current->info = $this->module_info;

        // test if the module have component
        if ( !empty( $this->module_info->component ) )
            $this->add_component();

        // test if the module have view
        if ( !empty( $this->module_info->view ) )
            $this->add_view();

        // test if the module have back_menu
        if ( !empty( $this->module_info->back_menu ) )
            $this->add_back_menu();

        // test if the module have data_schema
        if ( !empty( $this->module_info->model ) )
            $this->add_model();

        // test if the module have form
        if ( !empty( $this->module_info->form ) )
            $this->add_form();

        // test if the module have ajax
        if ( !empty( $this->module_info->ajax ) )
            $this->add_ajax();

        /**
         * [return the module buided]
>>>>>>> master
         */
        return $this->module_current;

      }
      /**
<<<<<<< HEAD
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
=======
       * [add_component add the components for the module]
       */
      public function add_component()
      {
          foreach ( $this->module_info->component as $key => $component ) {
              $this->module_current->add_component( (array) $component );
          }
      }
      /**
       * [add_component add the models for the module]
       */
      public function add_model()
      {
          foreach ( $this->module_info->model as $key => $model ) {
              $this->module_current->add_model( (array) $model );
          }
      }
      /**
       * [add_form description]
       */
      public function add_form(){
          foreach ( $this->module_info->form as $key => $form ) {
              $this->module_current->add_form( (array) $form );
          }
      }
      /**
       * [add_view description]
       */
      public function add_view(){
          foreach ( $this->module_info->view as $key => $view ) {
              $this->module_current->add_view( (array) $view );
          }
      }
      /**
       * [add_ajax description]
       */
      public function add_ajax(){
          foreach ( $this->module_info->ajax as $key => $ajax ) {
              $this->module_current->add_ajax( (array) $ajax );
          }
      }
      /**
       * [add_back_menu description]
       */
      public function add_back_menu(){
          foreach ( $this->module_info->back_menu as $key => $back_menu ) {
              $this->module_current->add_back_menu( (array) $back_menu );
          }
>>>>>>> master
      }

}
