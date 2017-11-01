<?php
namespace sp_framework\Modules\ModelTool\view;


<<<<<<< HEAD
class main extends \sp_framework\Pattern\Module\View
=======
class main extends \sp_framework\Pattern\Module\view
>>>>>>> master
{
  public function main()
  {
        $module = \sp_framework\get_module( 'ModelTool' );
        $module->component->Update->updateDatabse();

<<<<<<< HEAD
        \sp_framework\add_block( 'content',
            'Les Tables ont bien été mises à jour'
        );
=======
        echo 'viewsData';
>>>>>>> master
  }
}
