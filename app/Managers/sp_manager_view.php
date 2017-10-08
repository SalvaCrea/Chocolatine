<?php

namespace sp_framework;

class sp_manager_view
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
