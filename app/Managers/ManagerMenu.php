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

          $itemMenu = new \sp_framework\Pattern\Container\ItemMenu();
          $itemMenu->create( $value );

          $this->add_item_menu( $itemMenu );
        }
    }
    /**
     * Add items menu  in the templator
     * @param instance $TemplatorContent Instance of sp_framework\Pattern\TemplatorItemMenu::class;
     */
    function add_item_menu( \sp_framework\Pattern\Container\ItemMenu $itemMenu )
    {
        array_push( $this->container, $itemMenu );
    }
    public function get_configuration()
    {
        $this->configuration = \sp_framework\get_configuration( 'menu' );
    }

}
