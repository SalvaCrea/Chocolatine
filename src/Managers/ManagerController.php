<?php

namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;

class ManagerView extends Manager
{
  public $name = 'view';
  /**
   * Add view
   * @param array $args 
   */
  function add_view( $args )
  {
      $this->add( $args );
  }

}
