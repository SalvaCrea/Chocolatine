<?php
namespace sp_framework\Modules\Home\view;


class back_main extends \sp_framework\Pattern\Module\view
{
  public function main()
  {
        // $module = \sp_framework\get_module( 'GoogleApi' );
        //
        // $module->component->Connection->connection();

        \sp_framework\add_content( 'content', 'test');

        $this->renderTemplate();
  }
  public function admin( $requete,  $response, $args ){
        echo 'admin';
  }
}
