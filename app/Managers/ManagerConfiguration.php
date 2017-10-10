<?php

namespace sp_framework\Managers;

use sp_framework\Pattern\Manager;

class ManagerConfiguration extends Manager
{
  public function __construct()
  {
    $this->get_configurations();
  }
  /**
   * Add or Merge configuration
   * @param string $name name of key
   * @param mixed  $args contain of configuration
   */
  public function add_configuration( string $name , $args )
  {
      if ( empty( $this->container[$name] ) ) {
          $this->container[$name] = $args;
      }
      else{
        $this->container[$name] = array_merge( $this->container[$name],  $args);
      }
  }
  /**
   * Get all  file in folder configuration and stock the values
   * @return [type] [description]
   */
  public function get_configurations()
  {
      $files = \sp_framework\scanfolder( $this->get_path_folder_configuration() );

      foreach ( $files as $file) {

        $this->add_configuration(
            basename( $file, '.php'),
            require $this->get_path_folder_configuration() .'/'. $file
        );
        
      }

      if ( $this->environement == 'wordpress' ) {
          $this->wp_configuration_database();
      }
  }
  /**
   * Return configuration
   * @param  string the name of data
   * @return mixed return false is empty or value
   */
  public function get_configuration( $name )
  {
    if ( empty( $this->container[$name] ) ) {
        return $this->container[$name];
    }
    else{
        return false;
    }
  }
  /**
   * If environement is wordpress, get this database
   */
  public function wp_configuration_database(){
      $this->add_configuration( 'database', array(
          'database_type' => 'mysql',
          'database_name' => $wpdb->dbname,
          'server' => $wpdb->dbhost,
          'username' => $wpdb->dbuser,
          'password' => $wpdb->dbpassword,
          'charset' => $wpdb->charset
          )
      );
  }
  /**
   * Return the path folder configuration
   * @var string
   */
  public function get_path_folder_configuration()
  {
    return \sp_framework\get_folder() .  "/configuration";
  }
}
