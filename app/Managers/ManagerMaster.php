<?php

/**
 * Manage all manager
 */
namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerMaster extends Manager
{
  public $name = 'master';
  /**
   * List of manager
   * @var array
   */
  var $list_manager = [
    \sp_framework\Pattern\Manager\ManagerAjax::class,
    \sp_framework\Pattern\Manager\ManagerAsset::class,
    \sp_framework\Pattern\Manager\ManagerConfiguration::class,
    \sp_framework\Pattern\Manager\ManagerError::class,
    \sp_framework\Pattern\Manager\ManagerForm::class,
    \sp_framework\Pattern\Manager\ManagerModel::class,
    \sp_framework\Pattern\Manager\ManagerModule::class,
    \sp_framework\Pattern\Manager\ManagerService::class,
    \sp_framework\Pattern\Manager\ManagerView::class
  ];
  /**
   * Load the all manager
   */
  public function loadManager(){
      foreach ( $list_manager as $manager ) {
          $current_manager = new $manager();
          $this->{$current_manager->name} = $current_manager;
      }
  }
  /**
   * [add_form add a model]
   * @param [array] $args [description contain inmodelation for add model]
   */
  function add_manager( $args )
  {
      $this->container []=  $args;
  }
}
