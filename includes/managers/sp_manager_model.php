<?php

namespace salva_powa;

class sp_manager_model
{
  /**
   * [$list_form the list of the form]
   * @var [array]
   */
  var $list_model = array();
  /**
   * [add_form add a model]
   * @param [array] $args [description contain inmodelation for add model]
   */
  function add_model( $args )
  {
      $this->list_model []=  $args;
  }
}
