<?php

namespace Chocolatine\Component;

/**
 * Each container have one Element like :
 * Ajax | Component | Form | Model | Module | View | Etc...
 */

class Container{
      /**
       * Current name of element
       * @var string
       */
      public $name;
      /**
       * NameSpace of Element
       * @var string
       */
      public $namespace;
      /**
       * Module linked
       * @var string
       */
      public $module;
      /**
       * Class instancied
       * @var object
       */
      public $instance;
      /**
       * Path Folder of namespace
       * @var string
       */
      public $pathFolder;
      /**
       * [new description]
       * @return [type] [description]
       */
      public function __construct($namespace, $module = null)
      {
          $this->namespace = $namespace;
          if ($module != null) {
              $this->module = $module;
          }
          $this->name = substr(
              $namespace,
              strrpos($namespace, "\\") + 1
          );
      }
      public function make()
      {
          if (empty($this->instance)) {
              $namespace = $this->namespace;
              $this->instance = new  $namespace();
              $this->instance->name = $this->name;
              if ($this->module != null) {
                  $this->instance->module = $this->module;
              }
          }

          return $this->instance;
      }
      public function getPathFolder()
      {
          if (empty($this->instance)) {
              if (empty($this->instance)) $this->make();
              $reflection = new \ReflectionClass($this->instance);
          }

          return $this->pathFolder;
      }
}
