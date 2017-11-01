<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

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
