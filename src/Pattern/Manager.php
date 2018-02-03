<?php

namespace Chocolatine\Pattern;

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
  public function add( $namespace ){

        $arguments = explode( "\\", $namespace);

        $name      = $arguments[5];
        $module    = $arguments[3];
        $namespace = $namespace;

        $container = new \Chocolatine\Pattern\Container( $name, $namespace, $module );

        array_push( $this->container, $container );
  }
  /**
   *  Get one Element
   *  $name = 'nameElement'
   *  or
   *  $name = 'nameModule@nameView'
   * @return mixed name of view
   */
  public function find( $element_name ){
      $element_name = explode( "@", $element_name);
      /**
       *
       *    Check if module isset
       *
       */
      if ( !empty( $element_name[1] ) ) {
          $module = $element_name[0];
          $element_name = $element_name[1];
      }else{
          $element_name = $element_name[0];
      }

      /**
       *
       *    Search View in the container
       *
       */
      foreach ( $this->container  as $current_element ){
          if ( isset( $module ) ) {
              if ( $current_element->module == $module && $current_element->name == $element_name ) {
                  return $current_element;
              }
          }else{
              if ( $current_element->name == $element_name ) {
                  return $current_element;
              }
          }
      }
      return false;
  }
}
