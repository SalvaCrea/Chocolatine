<?php

namespace Chocolatine\Managers;

use Chocolatine;

use Chocolatine\Helper;
use Chocolatine\Component\Manager;
use Chocolatine\Component\Container;

class ManagerModule extends Manager
{
		public function loadModules()
		{
				$listModules = Helper::get_configuration('modules');
				array_map([ $this, 'loadModule' ], Helper::get_configuration('modules'));
		}
		public function loadModule($namespace)
		{
				$container = new Container($namespace);
				$container->make();
				$this->add($container);

				$service = Helper::get_service('ModuleFactory');
		}
		/**
		 * This function return un module by the name
		 * @param  string tthe name of the module for find
		 * @param  boolean execute true or false getter
		 * @return Mixed   Return Object if find or false is not find
		 */
		public function getModule($module_name, $getter = true)
		{
				if (false !== $key = Helper::array_find($this->container, 'name', $module_name)) {

						$module = $this->container[$key]['instance'];
						/**
						 * Execute the getter of the module
						 */
						if ($getter)
								$module->getter();

						return $module;

				}
				else
				{
						return false;
				}

		}
}
