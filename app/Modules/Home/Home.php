<?php

/**
 *  The module for the test
 */

namespace sp_framework\Modules\Home;

class Home extends \sp_framework\Pattern\Module\Module{
      function __construct(){
          \sp_framework\add_item_menu(
             array(
               'route'     => '/home',
               'view'      => 'Home@back_main',
               'text'      => 'Home',
               'icon'      => 'fa fa-text',
               'order'     => '1'
             )
           );
      }
}
