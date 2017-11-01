<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerForm extends Manager
{
  public $name = 'form';
  /**
   * [add_form add a form]
   * @param [array] $args [description contain information for add form]
   */
  function add_form( $args )
  {
      $this->add( $args );
  }
}
