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

<<<<<<< HEAD
          $itemMenu = new \sp_framework\Pattern\Container\ItemMenu();
          $itemMenu->create( $value );

          $this->add_item_menu( $itemMenu );
=======
          $TemplatorItemMenu = new \sp_framework\Pattern\TemplatorItemMenu();
          $TemplatorItemMenu->create( $value );

          $this->add_item_menu( $TemplatorItemMenu );
>>>>>>> master
        }
    }
    /**
     * Add items menu  in the templator
     * @param instance $TemplatorContent Instance of sp_framework\Pattern\TemplatorItemMenu::class;
     */
<<<<<<< HEAD
    function add_item_menu( \sp_framework\Pattern\Container\ItemMenu $itemMenu )
    {
        array_push( $this->container, $itemMenu );
=======
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
>>>>>>> master
    }
    public function get_configuration()
    {
        $this->configuration = \sp_framework\get_configuration( 'menu' );
    }

}
