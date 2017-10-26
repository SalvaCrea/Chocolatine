<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerAsset extends Manager
{
  public $name = 'asset';
  /**
   * Add Assets
   * @param string $type script or style
   * @param string $name name of asset
   * @param string $src  source of asset
   */
  public function add_assets( string $type, string $name, string $src )
  {
      $this->container[$type] []=  array(
        "name" => $name,
        "src" => $src,
      );
  }
  /**
   * add_css in the template twig
   * @param string $name name of assets
   * @param string $src  source of assets
   */
  function add_css( $name, $src ){
        $this->add_asset( 'styles', $name, $src );
  }
  /**
   * add_js in the template twig
   * @param string $name name of assets
   * @param string $src  source of assets
   */
  function add_js( $name, $src ){
        $this->add_asset( 'scripts', $name, $src );
  }
  /**
   * add_asset add assets in template twig
   * @param string $type Type assets scripts or styles
   * @param string $name name of assets
   * @param string $src  source of assets
   */
  function delete_asset( $type, $name ){
      foreach ( $this->container[$type]  as $key => $value) {
        if ( $value['name'] == $name ) {
            unset( $this->container[$type][$key] );
        }
      }
  }
  /**
   * delete_css in the template twig
   * @param string $name name of assets
   */
  function delete_css( $name ){
        $this->delete_asset( 'styles', $name );
  }
  /**
   * delete_js in the template twig
   * @param string $name name of assets
   */
  function delete_js( $name ){
        $this->delete_asset( 'scripts', $name );
  }
}
