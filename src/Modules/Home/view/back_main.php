<?php
namespace Chocolatine\Modules\Home\view;


class back_main extends \Chocolatine\Pattern\Module\View
{
  public function main()
  {
        // $module = \Chocolatine\get_module( 'GoogleApi' );
        //
        // $module->component->Connection->connection();

        \Chocolatine\add_block( 'content', 'Bonjour vous êtes sur la page accueil');

  }
  public function admin(){
        echo 'admin';
  }
}
