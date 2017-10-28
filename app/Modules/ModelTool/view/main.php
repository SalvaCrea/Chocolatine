<?php
namespace sp_framework\Modules\ModelTool\view;


class main extends \sp_framework\Pattern\Module\view
{
  public function main()
  {
        $module = \sp_framework\get_module( 'ModelTool' );

        $module->component->Update->updateDatabse();
  }
}
