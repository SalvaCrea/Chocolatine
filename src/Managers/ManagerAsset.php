<?php

namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;

class ManagerAsset extends Manager
{
  public $name = 'asset';
  /**
   * Data convert for js
   * @var array
   */
  public $data = array();
  public function __construct(){
      $this->add_by_configuration();
  }
  /**
   * add_by_configuration add the assets contain the configuration manager
   */
  public function add_by_configuration(){
      $assets = \Chocolatine\get_configuration( 'assets' );
      foreach ( $assets as $type => $content ) {
        foreach ( $content as $asset ) {
          $position = '';
          if ( !empty( $asset['position'] )) {
            $position = $asset['position'];
          }
          $this->add_asset( $type, $asset['name'], $asset['src'], $position);
        }
      }
  }
  /**
   * Add Assets
   * @param string $type script or style
   * @param string $name name of asset
   * @param string $src  source of asset
   * @param string $position  Position in header | footer
   */
  public function add_asset( $type, $name, $src, $position = '' )
  {
      $container = new \Chocolatine\Pattern\Container\Asset();
      $this->container []=  $container->create(
        $type,
        $name,
        $src,
        $position
      );
  }
  /**
   * add_css in the template twig
   * @param string $name name of assets
   * @param string $src  source of assets
   */
  public function add_css( $name, $src ){
        $this->add_asset( 'style', $name, $src );
  }
  /**
   * add_js in the template twig
   * @param string $name name of assets
   * @param string $src  source of assets
   * @param string $position  Position in header | footer
   */
  public function add_js( $name, $src, $position = 'footer'){
        $this->add_asset( 'script', $name, $src, $position );
  }
  /**
   * Add data for convert Js data
   * @param string $key  the name of data key
   * @param mixed $data  can be array | string | etc...
   */
  public function add_data( $key, $data ){
      $this->data[$key] = $data;
  }
  public function get_data(){
      return $this->data;
  }
  /**
   * add_asset add assets in template twig
   * @param string $type Type assets scripts or styles
   * @param string $name name of assets
   * @param string $src  source of assets
   */
  public function delete_asset( $type, $name ){
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
  public function delete_css( $name ){
        $this->delete_asset( 'style', $name );
  }
  /**
   * delete_js in the template twig
   * @param string $name name of assets
   */
  public function delete_js( $name ){
        $this->delete_asset( 'script', $name );
  }
  /**
   * Get all assets
   * @return array
   */
  public function get_assets(){
    return array(
      'script' => $this->get_js(),
      'style'    => $this->get_css()
    );
  }
  /**
   * Get all css
   * @return array list css
   */
  public function get_css(){
      return \Chocolatine\array_clean(
        $this->container,
        'type',
        'style'
      );
  }
  /**
   * Get all js
   * @return array list js
   */
  public function get_js(){
      return \Chocolatine\array_clean(
        $this->container,
        'type',
        'script'
      );
  }
  /**
   * Get all js footer
   * @return array list js footer
   */
  public function get_js_footer(){
      return \Chocolatine\array_clean(
        $this->get_js(),
        'position',
        'footer'
      );
  }
  /**
   * Get all ks header
   * @return array list ks header
   */
  public function get_js_header(){
      return \Chocolatine\array_clean(
        $this->get_js(),
        'position',
        'header'
      );
  }
}
