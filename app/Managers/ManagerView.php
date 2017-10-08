<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerView extends Manager
{
  /**
   * [$list_form the list of the form]
   * @var [array]
   */
  var $list_view = array();
  /**
   * [add_form add a view]
   * @param [array] $args [description contain inviewation for add view]
   */
  function add_view( $args )
  {
      $this->list_view []=  $args;
  }

}
