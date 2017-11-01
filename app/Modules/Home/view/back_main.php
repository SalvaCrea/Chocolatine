<?php
namespace sp_framework\Modules\Home\view;


class back_main extends \sp_framework\Pattern\Module\View
{
  public function main()
  {
        // $module = \sp_framework\get_module( 'GoogleApi' );
        //
        // $module->component->Connection->connection();

<<<<<<< HEAD
        \sp_framework\add_block( 'content', 'Bonjour vous êtes sur la page accueil');
=======
        \sp_framework\add_content( 'content', 'Bonjour vous êtes sur la page accueil');
>>>>>>> master

  }
  public function admin(){
        echo 'admin';
  }
}
