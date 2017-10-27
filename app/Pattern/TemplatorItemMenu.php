<?php
namespace sp_framework\Pattern;

class TemplatorItemMenu{
      /**
       * Route
       * /post
       * Can have a parent if
       * /post/edit
       * @var string
       */
      public $route = '';
      /**
       * View callable
       * Just View
       * my_view
       * View + module
       * module/view
       * @var string
       */
      public $view;
      /**
       * Type of menu
       * show |
       * hide |
       * showcall -> show only called
       * @var string
       */
      public $type = 'show';
      /**
       * Order in menu
       * @var int
       */
      public $order = 0;
      /**
       * Icon the svg img
       * @var string
       */
      public $icon;
      /**
       * Content text
       * @var string string
       */
      public $text;
      /**
       * The name of menu
       * @var string string
       */
      public $menu_name = 'main';
      /**
       * Arguments for create a Items Menu
       * @param  array  $args [description]
       * @return [type]       [description]
       */
      public function create( array $args ){

            $default_args = array(
              'route'   => '',
              'view'   => '',
              'text'   => '',
              'icon'   => '',
              'order'   => '',
              'menu_name'   => '',
            );

            /**
             * Fusion and Arguments
             */
            $args = array_filter( array_merge( $default_args , $args) );

            /**
             *  Insert data arguments in this instance
             */
            foreach ( $args as $key => $value ) {
               $this->$key = $value;
            }

      }
 }
