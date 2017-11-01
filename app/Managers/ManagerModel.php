<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

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
