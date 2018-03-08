<?php

namespace Chocolatine\Managers;

use Chocolatine\Component\Manager;
use Chocolatine\Component\Container;
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
          array_map([$this, 'loader'], $this->configuration);
      }
      /**
       *  load all services
       * @param   $nameClass Name of calss
       */
      public function loader($namespace)
      {
          $container = new Container($namespace);
  				$this->add($container);
      }
      /**
       * Return a specific service
       * @param  string $name_service The name of service
       * @return mixed              the service if find or return false
       */
      public function getService($name_service)
      {
          $key = Helper::array_find($this->container, 'name', $name_service);
          if ($key!=false) {
              $service = $this->container[$key]->make();
              $service->getter();
              return $service;
          }
          return false;
      }
      public function getConfiguration()
      {
          $this->configuration = Helper::get_configuration('services');
      }
}
