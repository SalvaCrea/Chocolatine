<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerModel extends Manager
{
  public $name = 'model';
  /**
   * [add_form add a model]
   * @param [array] $args [description contain inmodelation for add model]
   */
  function add_model( $args )
  {
      $this->container []=  $args;
  }
}
