<?php
namespace Chocolatine\Component\Container;

class Asset extends \Chocolatine\Component\Container{
      /**
       * Type of Assets
       * script | css
       * @var string
       */
      public $type;
      /**
       * Order in content
       * @var int
       */
      public $order = 0;
      /**
       * The source of asset
       * @var string
       */
      public $src;

      public function __construct(){}
      public function create( $type, $name, $src, $position =  'header', $args = [] )
      {

            $this->type     = $type;
            $this->name     = $name;
            $this->src      = $src;
            $this->position = $position;

            if ( !empty( $args ) ) {
                foreach ( $args as $key => $value) {
                  $this->$key = $value;
                }
            }
            return $this;
      }
 }
