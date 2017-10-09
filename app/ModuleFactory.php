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
       * [$module_current the module being created]
       * @var [stdClass]
       */
      var $module_current;
      /**
       * [$module_info all info around the module]
       * @var [object]
       */
      var $module_info;
      public function __construct()
      {

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
         */
        return $this->module_current;

      }
      /**
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
      }

}
