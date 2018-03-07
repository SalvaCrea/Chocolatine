<?php

namespace Chocolatine\Component;

/**
 * Each container have one Element like :
 * Ajax | Component | Form | Model | Module | View | Etc...
 */

abstract class Container{
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
       * [new description]
       * @return [type] [description]
       */
      public function __construct( $name, $namespace, $module = null)
      {
            $this->name = $name;
            $this->namespace = $namespace;
            if ($module != null) {
                $this->module = $module;.
            }
      }
      public function make()
      {

          $namespace = $this->namespace;
          $instance = new  $namespace();
          $instance->name = $this->name;
          $instance->module = $this->module;

          return $instance;
      }
}
