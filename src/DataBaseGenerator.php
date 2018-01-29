<?php
namespace Chocolatine;

/**
 *  Class use for create all DataTable by Schema
 */
class ClassName extends AnotherClass
{
  function __construct()
  {
      $this->db = \Chocolatine\get_service( 'database' )->database;
  }
}
