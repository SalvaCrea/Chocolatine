<?php

namespace Chocolatine\Services;

use Medoo\Medoo;

class DataBase extends \Chocolatine\Pattern\Service{

  public $name = 'form';

  /**
   * Number of form created
   * @var int
   */
  public $numberForm = 0;

  public function __construct(){

  }
  /**
   * [generate_form description]
   * @param  string $model Name of Model
   * @param  string $form  Name of Form
   * @return string        form html
   */
  public function generate_form( $model, $form = '' ){

      $this->numberForm++;
      if ( $this->numberForm === 1 ) {
        $this->add_asset_form();
      }

      if ( !empty( $form ) ) {
          $form = \Chocolatine\get_form( $model, true );
      }

      return 'form';

  }
  public function add_asset_form(){
      $asset_manager = \Chocolatine\get_manager( 'asset' );

      $asset_manager->add_js(
        'angular',
        'bower_components/angular/angular.min.js'
      );

      $asset_manager->add_js(
        'sanitize',
        'bower_components/angular-sanitize/angular-sanitize.min.js'
      );

      $asset_manager->add_js(
        'tv4',
        'bower_components/tv4/tv4.js'
      );

      $asset_manager->add_js(
        'ObjectPath',
        'bower_components/objectpath/lib/ObjectPath.js'
      );

      $asset_manager->add_js(
        'schema-form',
        'bower_components/angular-schema-form/dist/schema-form.min.js'
      );

      $asset_manager->add_js(
        'bootstrap-decorator',
        'bower_components/angular-schema-form/dist/bootstrap-decorator.min.js'
      );

      $asset_manager->add_js(
        'formGenerator',
        'bower_components/angular-schema-form/dist/formGenerator.js'
      );
  }
}
