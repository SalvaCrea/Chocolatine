<?php
/*
 * This file build the modules
 *
 * (c) Cardona Salvador <contact@salva-crea.fr>
 *
 */

namespace salva_powa;

class module_factory
{
      /**
       * [$module_current the module being created]
       * @var [stdClass]
       */
      var $module_current;
      /**
       * [$module_info all info around the module]
       * @var [object]
       */
      var $module_info;
      public function __construct()
      {

      }
      /**
       * [build_module method use for build a module]
       * @param  [string] $path_folder [the path of the folder]
       * @return [object]              [the module builded]
       */
      public function build_module( $path_folder )
      {

        $this->module_info = json_decode( file_get_contents( $path_folder ) );

        return $module;
      }

}
