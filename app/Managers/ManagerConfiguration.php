<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerConfiguration extends Manager
{
  /**
   * [add_form add a view]
   * @param array $args [description contain inviewation for add view]
   */
  function add_configuration( $args )
  {
      $this->container[] =  $args;
  }

}
