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
  var $container = [
    ManagerConfiguration::class,
    ManagerAjax::class,
    ManagerAsset::class,
    ManagerError::class,
    ManagerForm::class,
    ManagerModel::class,
    ManagerModule::class,
    ManagerService::class,
    ManagerView::class,
    ManagerComponent::class
  ];
  /**
   * Load the all manager
   */
  public function loadManager(){
      foreach ( $this->container as $manager ) {
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
