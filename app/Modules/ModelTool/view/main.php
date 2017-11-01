<?php
namespace sp_framework\Modules\ModelTool\view;


class main extends \sp_framework\Pattern\Module\View
{
  public function main()
  {
        $module = \sp_framework\get_module( 'ModelTool' );
        $module->component->Update->updateDatabse();

        \sp_framework\add_block( 'content',
            'Les Tables ont bien été mises à jour'
        );
  }
}
