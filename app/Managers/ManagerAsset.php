<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerAsset extends Manager
{
  public $name = 'asset';
<<<<<<< HEAD
  public function __construct(){
      $this->add_by_configuration();
  }
  /**
   * add_by_configuration add the assets contain the configuration manager
   */
  public function add_by_configuration(){
      $this->container = \sp_framework\get_configuration( 'assets' );
  }
=======
>>>>>>> master
  /**
   * Add Assets
   * @param string $type script or style
   * @param string $name name of asset
   * @param string $src  source of asset
<<<<<<< HEAD
   * @param string $position  Position in header | footer
   */
  public function add_assets( string $type, string $name, string $src, string $position = '' )
=======
   */
  public function add_assets( string $type, string $name, string $src )
>>>>>>> master
  {
      $this->container[$type] []=  array(
        "name" => $name,
        "src" => $src,
<<<<<<< HEAD
        "position" => $position
=======
>>>>>>> master
      );
  }
  /**
   * add_css in the template twig
   * @param string $name name of assets
   * @param string $src  source of assets
   */
<<<<<<< HEAD
  function add_css( string $name, string $src ){
        $this->add_asset( 'style', $name, $src );
=======
  function add_css( $name, $src ){
        $this->add_asset( 'styles', $name, $src );
>>>>>>> master
  }
  /**
   * add_js in the template twig
   * @param string $name name of assets
   * @param string $src  source of assets
<<<<<<< HEAD
   * @param string $position  Position in header | footer
   */
  function add_js( string $name, string $src, string $position = 'footer'){
        $this->add_asset( 'script', $name, $src, $position );
=======
   */
  function add_js( $name, $src ){
        $this->add_asset( 'scripts', $name, $src );
>>>>>>> master
  }
  /**
   * add_asset add assets in template twig
   * @param string $type Type assets scripts or styles
   * @param string $name name of assets
   * @param string $src  source of assets
   */
<<<<<<< HEAD
  function delete_asset( string $type, string $name ){
=======
  function delete_asset( $type, $name ){
>>>>>>> master
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
<<<<<<< HEAD
        $this->delete_asset( 'style', $name );
=======
        $this->delete_asset( 'styles', $name );
>>>>>>> master
  }
  /**
   * delete_js in the template twig
   * @param string $name name of assets
   */
  function delete_js( $name ){
<<<<<<< HEAD
        $this->delete_asset( 'script', $name );
=======
        $this->delete_asset( 'scripts', $name );
>>>>>>> master
  }
}
