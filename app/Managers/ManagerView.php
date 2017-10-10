<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerView extends Manager
{
  /**
   * [add_form add a view]
   * @param [array] $args [description contain inviewation for add view]
   */
  function add_view( $args )
  {
      $this->container []=  $args;
  }

}
