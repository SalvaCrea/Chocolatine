<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerService extends Manager
{
      /**
       * container of configuration
       * @var [type]
       */
      public $configuration;
      public function __construct(){
          $this->init();
      }
      public function init(){

          $this->get_configuration();
          $this->class_loader();

      }
      /**
       * Foreach list service class and wallback this
       */
      public function class_loader(){
          array_map( [$this, 'loader'], $this->configuration['service']);
      }
      /**
       *  load all services
       * @param   $name_class Name of calss
       */
      public function loader(  $name_class ){
          $instance = new  $name_class();
          array_push( $this->container,
              $instance
          );
      }
      public function get_configuration()
      {
          $this->configuration = require \sp_framework\get_core()->path_folder . '/configuration/services.php';
      }

}
