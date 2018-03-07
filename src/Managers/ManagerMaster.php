<?php

/**
 * Manage all manager
 */
namespace Chocolatine\Managers;

use Chocolatine\Component\Manager;

class ManagerMaster extends Manager
{
    /**
     * List of manager
     * @var array
     */
    var $listManager = [
        ManagerConfiguration::class,
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
    public function loadManager()
    {
        array_map([$this, 'addManager'], $this->listManager);
    }
    /**
     * Add manager
     * @param string $className   Namespace of Manager
     * @param string $managerName Name Of manager
     */
    function addManager($classNameManager, $name = null)
    {
        $manager = new $classNameManager();
        if ($name != null) {
            $manager->name = $name;
        }
        // generate Name By name Class
        elseif (empty($manager->name)) {
            $manager->name = strtolower (
                str_replace(
                    // Delete the word Manager
                    "Manager",
                    "",
                    substr(
                        $classNameManager,
                        strrpos($classNameManager, "\\") + 1
                   )
               )
           );
        }
        $this->{$manager->name} = $manager;
    }
}
