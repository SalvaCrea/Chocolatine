<?php

namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;

class ManagerError extends Manager
{
  public $name = 'error';
  /**
   *  Add error in container
   * @param array $args Add Error an container
   */
  function add_error( $args )
  {
      $this->add( $args );
  }

}