<?php
namespace sp_framework\Modules\Home\view;


class back_main extends \sp_framework\Pattern\Module\View
{
  public function main()
  {
        // $module = \sp_framework\get_module( 'GoogleApi' );
        //
        // $module->component->Connection->connection();

        \sp_framework\add_block( 'content', 'Bonjour vous êtes sur la page accueil');

  }
  public function admin(){
        echo 'admin';
  }
}
