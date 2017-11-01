<?php
namespace sp_framework\Pattern\Container;

class Block extends \sp_framework\Pattern\Container{
      /**
       * Type of Content
       * string | callback
       * @var string
       */
      public $type = 'string';
      /**
       * Order in content
       * @var int
       */
      public $order = 0;
      /**
       * Name of block
       * @var string
       */
      public $block_name;
      /**
       * Content
       * @var mixed string | callabble
       */
      public $content;
      /**
       * title
       * @var string title of block
       */
      public $title;
      /**
       * Create a content for the templator
       * @param  string  $block_name
       * @param  mixed   $content
       * @param  string  $type
       * @param  integer $order
       */
      public function __construct(){}
      public function create( $block_name, $content, $args = [] ){

            $this->block_name = $block_name;
            $this->content    = $content;
            if ( !empty( $args ) ) {
                foreach ( $args as $key => $value) {
                  $this->$key = $value;
                }
            }



      }
 }
