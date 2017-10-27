<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerError extends Manager
{
  public $name = 'error';
  /**
   *  Add error in container
   * @param array $args Add Error an container
   */
  function add_error( $args )
  {
      $this->container[] =  $args;
  }

}
