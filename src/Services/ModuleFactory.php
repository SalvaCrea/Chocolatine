<?php
/*
 * This file build the modules
 *
 * (c) Cardona Salvador <contact@salva-crea.fr>
 *
 */

namespace Chocolatine\Services;

class ModuleFactory extends \Chocolatine\Component\Service
{
      /**
       * public Container of relation manager
       * @var array
       */
      /**
       * buildModule method use for build a module
       * @param  string $moduleName  name of module
       * @param  string $pathFolder the path of the folder
       * @return object              the module builded
       */
      public function buildModule($moduleName, $pathFolder, $namespace)
      {
        /**
         *
         * Create a instance of the module
         *
         */

         $class = $namespace . "\\" . $moduleName ;

         $this->moduleCurrent = new $class();
         $this->moduleCurrent->path_folder = $pathFolder;

         foreach ($this->managerRelations as $key => $value) {
             $this->tryFindElement($value, $namespace , $pathFolder);
         }

        /**
         * return the module buided
         */
        return $this->moduleCurrent;

      }
      /**
       * tryFindElement try find element in module
       * @param array  $manager     Manager correspond
       * @param string $namespace Name of namespace
       * @param string $pathFolder Path of module
       */
      public function tryFindElement($manager, $namespace, $pathFolder){
            /**
             *  Find element in folder
             */
            $currentFolder = $pathFolder . "/" . $manager['folder'];
            /**
             * Test if folder exist
             */
            if (!is_dir ($currentFolder)) { return false; }

            if (!empty( $list_element = Helper::scanfolder($currentFolder))) {
              /**
               *  Serach manager link of folder
               */
                if (false !== ($current_manager = Helper::get_manager($manager['name']))) {

                    $this->moduleCurrent->component = new \stdClass();

                    foreach ($list_element as $element) {

                      $element_name = basename($element, ".php");
                      $element_namespace = $namespace . "\\" . $manager['name'] . "\\" . $element_name;
                      /**
                       * Instanced Element if the Element if a component
                       */
                      if ($manager['name'] == 'component') {
                          $this->moduleCurrent->component->$element_name = new $element_namespace();
                      }

                      $this->tryAddElement(
                        $current_manager,
                        $element_namespace
                     );
                    }

                }
            }
      }
      /**
       * tryFindElement try add element in module
       * @param object  $manager           manager used
       * @param string $element_namespace  namepsace element
       */
      public function tryAddElement( $manager, $element_namespace){
            $manager->add($element_namespace);
      }

}
