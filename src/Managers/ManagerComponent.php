<?php

namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;

class ManagerComponent extends Manager
{
  public $name = 'component';
  /**
   * Add a model
   * @param array $args 
   */
  function add_model( $args )
  {
      $this->add( $args );
  }
}
