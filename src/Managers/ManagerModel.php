<?php

namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;

class ManagerModel extends Manager
{
  public $name = 'model';
  /**
   * Add a form
   * @param array $args
   */
  function add_model( $args )
  {
      $this->add( $args );
  }
}
