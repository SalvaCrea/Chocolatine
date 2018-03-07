<?php

namespace Chocolatine\Managers;

use Chocolatine\Component\Manager;

use Chocolatine\Helper;

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

          $this->getConfiguration();
          $this->classLoader();

      }
      /**
       * Foreach list service class and wallback this
       */
      public function classLoader()
      {
          array_map( [$this, 'loader'], $this->configuration );
      }
      /**
       *  load all services
       * @param   $nameClass Name of calss
       */
      public function loader( $nameClass )
      {
          $instance = new  $nameClass();
          array_push( $this->container,
              $instance
          );
      }
      /**
       * Return a specific service
       * @param  string $name_service The name of service
       * @return mixed              the service if find or return false
       */
      public function get_service( $name_service )
      {
          $key = Helper::array_find( $this->container, 'name', $name_service );
          return $this->container[$key];
      }
      public function getConfiguration()
      {
          $this->configuration = Helper::get_configuration( 'services' );
      }
}
