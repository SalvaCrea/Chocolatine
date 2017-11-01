<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerAsset extends Manager
{
  public $name = 'asset';
  public function __construct(){
      $this->add_by_configuration();
  }
  /**
   * add_by_configuration add the assets contain the configuration manager
   */
  public function add_by_configuration(){
      $this->container = \sp_framework\get_configuration( 'assets' );
  }
  /**
   * Add Assets
   * @param string $type script or style
   * @param string $name name of asset
   * @param string $src  source of asset
   * @param string $position  Position in header | footer
   */
  public function add_assets( $type, $name, $src, $position = '' )
  {
      $this->container[$type] []=  array(
        "name" => $name,
        "src" => $src,
        "position" => $position
      );
  }
  /**
   * add_css in the template twig
   * @param string $name name of assets
   * @param string $src  source of assets
   */
  function add_css( $name, $src ){
        $this->add_asset( 'style', $name, $src );
  }
  /**
   * add_js in the template twig
   * @param string $name name of assets
   * @param string $src  source of assets
   * @param string $position  Position in header | footer
   */
  function add_js( $name, $src, $position = 'footer'){
        $this->add_asset( 'script', $name, $src, $position );
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
        $this->delete_asset( 'style', $name );
  }
  /**
   * delete_js in the template twig
   * @param string $name name of assets
   */
  function delete_js( $name ){
        $this->delete_asset( 'script', $name );
  }
}
