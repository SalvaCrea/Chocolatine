<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerService extends Manager
{
      public $name = 'service';
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
          array_map( [$this, 'loader'], $this->configuration );
      }
      /**
       *  load all services
       * @param   $name_class Name of calss
       */
      public function loader( $name_class ){
          $instance = new  $name_class();
          array_push( $this->container,
              $instance
          );
      }
      /**
       * Return a specific service
       * @param  string $name_service The name of service
       * @return mixed              the service if find or return false
       */
      public function get_service( $name_service ){
          $key = \sp_framework\array_find( $this->container, 'name', $name_service );
          return $this->container[$key];
      }
      public function get_configuration()
      {
          $this->configuration = \sp_framework\get_configuration( 'services' );
      }

}
