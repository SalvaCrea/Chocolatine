<?php
/**
 * Class sp_core
 */

namespace Chocolatine;

use Chocolatine\Helper;

class Core
{
			/**
			 *  Name of the application
			 * @var string
			 */
			public $application;
			/**
			 * Path of Application
			 * @var string
			 */
			public $pathApplication;
			/**
			 *  this is the root folder
			 * @var string
			 */
			public $pathFolder;
			/**
			 * this a web url
			 * @var string
			 */
			public $url_folder;
			/**
			* The etat of core, he can have three etat
			* front | api | admin | null
			* @var string
			 */
			public $etat;
			/**
			* The default is false, if i true than is dev mode
			* @var boolean
			 */
			public $is_dev = false;
			/**
			 * manager contain the managers
			 * @var [stdclass]
			 */
			public $manager;

			/**
			 * Path Application
			 * @param string $pathApplication path folder of application
			 */
			public function __construct($pathApplication)
			{
					$this->setPathApplication($pathApplication);

					$this->pathFolder = dirname(dirname(__FILE__));
					Helper::$core = $this;
			}
			public function setPathApplication($pathApplication)
			{
					$this->pathApplication = $pathApplication;
			}
			public function getPathApplication()
			{
					return $this->pathApplication;
			}
			/**
			 * This function load all modules
			 */
			public function init()
			{
					$this->loadManagers();
					$this->loadModules();
			}
			public function beforeLoadManager(){}
			public function loadManagers()
			{
					$this->beforeLoadManager();
					$this->manager = new Managers\ManagerMaster();
					/**
					 * Find and load all Managers
					 */
					$this->beforeLoadModules();
					$this->manager->loadManager();
					$this->afterLoadManagers();
			}
			public function beforeLoadModules(){}
			public function afterLoadManagers(){}
			public function loadModules()
			{
					/**
					 * Find and load all Modules
					 */
					$this->manager->module->loadModules();
			}
			public function afterLoadModules(){}
}
