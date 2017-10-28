<?php
namespace sp_framework\Modules\GoogleApi\view;


class connection extends \sp_framework\Pattern\Module\view
{
  public function main()
  {
        $module = \sp_framework\get_module( 'GoogleApi' );
        $module->component->Connection->connection();
        echo 'test';
  }
}
