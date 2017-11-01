<?php
namespace sp_framework;

/**
 *  Class use for create all DataTable by Schema
 */
class ClassName extends AnotherClass
{
  function __construct()
  {
      $this->db = \sp_framework\get_service( 'database' )->database;
  }
}
