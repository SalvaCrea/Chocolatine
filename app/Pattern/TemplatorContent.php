<?php
namespace sp_framework\Pattern;

class TemplatorContent{
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
       * Create a content for the templator
       * @param  string  $block_name
       * @param  mixed   $content
       * @param  string  $type
       * @param  integer $order
       */
      public function create( string $block_name, $content, $type = '', int $order = 0){

            $this->block_name = $block_name;
            $this->content   = $content;
            $this->type      = $type;
            $this->order     = $order;

      }
 }
