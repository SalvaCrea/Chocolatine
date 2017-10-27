<?php

namespace sp_framework\Pattern;

class Manager{
  /**
   * Name of Manager
   * @var string
   */
  public $name;
  /**
   *  Container
   * @var [type]
   */
  public $container = array();
  public function init(){}
  /**
   * user for add element
   * @param object $object_instanced the element instanced
   */
  public function add( $object_instanced ){
        $arguments = explode( "\\", $object_instanced);

        $args = [
          "name" => $arguments[5],
          "module" => $arguments[3],
          "namespace" => $object_instanced,
          "instance" => ""
        ];

        array_push( $this->container, $args );
  }
}
