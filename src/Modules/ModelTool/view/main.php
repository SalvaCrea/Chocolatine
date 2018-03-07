<?php
namespace Chocolatine\Modules\ModelTool\view;


class main extends \Chocolatine\Pattern\Module\View
{
  public function main()
  {
        $module = \Chocolatine\get_module('ModelTool');
        $module->component->Update->updateDatabse();

        \Chocolatine\add_block('content',
            'Les Tables ont bien été mises à jour'
       );
  }
}
