<?php

/**
 * Manage all manager
 */
namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;

class ManagerMaster extends Manager
{
    public $name = 'master';
    /**
     * List of manager
     * @var array
     */
    var $listManager = [
        ManagerConfiguration::class,
        ManagerAjax::class,
        ManagerAsset::class,
        ManagerError::class,
        ManagerForm::class,
        ManagerModel::class,
        ManagerModule::class,
        ManagerService::class,
        ManagerController::class,
        ManagerComponent::class,
        ManagerMenu::class,
        ManagerBlock::class
    ];
    /**
     * Load the all manager
     */
    public function loadManager(){
        array_map( [$this, 'addManager'], $this->listManager);
    }
    /**
     * Add manager
     * @param string $className   Namespace of Manager
     * @param string $managerName Name Of manager
     */
    function addManager( $classNameManager, $name = "" )
    {
        $manager = new $classNameManager();
        if ( $name != '' ) {
            $manager->name = $name;
        }
        $this->{$manager->name} = $manager;
    }
}
