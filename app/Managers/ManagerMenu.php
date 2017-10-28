<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerMenu extends Manager
{
  public $name = 'menu';

    public function __construct(){
       $this->init();
    }
    public function init(){

     $this->get_configuration();
     $this->declare_menu();
    }
    public function declare_menu(){
        foreach ( $this->configuration as $value ) {

          $TemplatorItemMenu = new \sp_framework\Pattern\TemplatorItemMenu();
          $TemplatorItemMenu->create( $value );

          $this->add_item_menu( $TemplatorItemMenu );
        }
    }
    /**
     * Add items menu  in the templator
     * @param instance $TemplatorContent Instance of sp_framework\Pattern\TemplatorItemMenu::class;
     */
    function add_item_menu( \sp_framework\Pattern\TemplatorItemMenu $TemplatorItemMenu )
    {
      /**
       *
       * Create the menu if undefined
       *
       */
      if ( empty ( $this->container[ $TemplatorItemMenu->menu_name ] ) ) {
        $this->container[ $TemplatorItemMenu->menu_name ] = array();
      }

      array_push( $this->container[ $TemplatorItemMenu->menu_name ], $TemplatorItemMenu );
    }
    public function get_configuration()
    {
        $this->configuration = \sp_framework\get_configuration( 'menu' );
    }

}
