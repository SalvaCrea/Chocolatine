<?php
namespace sp_framework\Modules\GoogleApi\view;


class main extends \sp_framework\Pattern\Module\view
{
  public function list()
  {

        $module = \sp_framework\get_module( 'GoogleApi' );
        $module->component->Connection->connection();


  }
}
