<?php

namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;

use Chocolatine\Helper;

class ManagerMenu extends Manager
{
      public $name = 'menu';

      public function __construct()
      {
         $this->init();
      }
      public function init()
      {
         $this->declare_menu();
      }
      public function declare_menu()
      {
          if ( !empty( Helper::get_configuration( 'menu' ) ) ) {
              foreach ( Helper::get_configuration( 'menu' ) as $value ) {
                  $itemMenu = new \Chocolatine\Pattern\Container\ItemMenu();
                  $itemMenu->create( $value );

                  $this->add_item_menu( $itemMenu );
              }
          }
      }
      /**
       * Add items menu  in the templator
       * @param instance $TemplatorContent Instance of Chocolatine\Pattern\TemplatorItemMenu::class;
       */
      function add_item_menu( \Chocolatine\Pattern\Container\ItemMenu $itemMenu )
      {
          array_push( $this->container, $itemMenu );
      }
}
