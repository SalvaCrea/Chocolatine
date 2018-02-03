<?php

namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;

use Chocolatine\Helper;

class ManagerAsset extends Manager
{
  public $name = 'asset';
  /**
   * Data convert for js
   * @var array
   */
  public $data = array();
  public function __construct(){
      $this->addByConfiguration();
  }
  /**
   * add_by_configuration add the assets contain the configuration manager
   */
  public function addByConfiguration(){

      $assets = Helper::get_configuration( 'assets' );
      foreach ( $assets as $type => $content ) {
          foreach ( $content as $asset ) {
              $position = '';
              if ( !empty( $asset['position'] )) {
                  $position = $asset['position'];
              }
              $this->addAsset( $type, $asset['name'], $asset['src'], $position);
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
  public function addAsset( $type, $name, $src, $position = '' )
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
   * addCss in the template twig
   * @param string $name name of assets
   * @param string $src  source of assets
   */
  public function addCss( $name, $src ){
        $this->addAsset( 'style', $name, $src );
  }
  /**
   * addJs in the template twig
   * @param string $name name of assets
   * @param string $src  source of assets
   * @param string $position  Position in header | footer
   */
  public function addJs( $name, $src, $position = 'footer'){
        $this->addAsset( 'script', $name, $src, $position );
  }
  /**
   * Add data for convert Js data
   * @param string $key  the name of data key
   * @param mixed $data  can be array | string | etc...
   */
  public function addData( $key, $data ){
      $this->data[$key] = $data;
  }
  public function get_data(){
      return $this->data;
  }
  /**
   * addAsset add assets in template twig
   * @param string $type Type assets scripts or styles
   * @param string $name name of assets
   * @param string $src  source of assets
   */
  public function deleteAsset( $type, $name ){
      foreach ( $this->container[$type]  as $key => $value) {
        if ( $value['name'] == $name ) {
            unset( $this->container[$type][$key] );
        }
      }
  }
  /**
   * deleteCss in the template twig
   * @param string $name name of assets
   */
  public function deleteCss( $name ){
        $this->deleteAsset( 'style', $name );
  }
  /**
   * deleteJs in the template twig
   * @param string $name name of assets
   */
  public function deleteJs( $name ){
        $this->deleteAsset( 'script', $name );
  }
  /**
   * Get all assets
   * @return array
   */
  public function getAssets(){
    return array(
        'script' => $this->getJs(),
        'style'    => $this->get_css()
    );
  }
  /**
   * Get all css
   * @return array list css
   */
  public function getCss(){
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
  public function getJs(){
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
  public function getJsfooter(){
      return \Chocolatine\array_clean(
          $this->getJs(),
          'position',
          'footer'
      );
  }
  /**
   * Get all ks header
   * @return array list ks header
   */
  public function getJsHeader(){
      return \Chocolatine\array_clean(
          $this->getJs(),
          'position',
          'header'
      );
  }
}
