<?php

namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;

class ManagerConfiguration extends Manager
{
    public $name = 'configuration';

    public $environement = "custom";

    public function __construct()
    {
        $this->get_configurations();
    }
    /**
     * Add or Merge configuration
     * @param string $name name of key
     * @param mixed  $args contain of configuration
     */
    public function add_configuration( $name , $args )
    {
        if ( empty( $this->container[$name] ) ) {
            $this->container[$name] = $args;
        } else {
            $this->container[$name] = array_merge( $this->container[$name],  $args);
        }
    }
    /**
     * Get all  file in folder configuration and stock the values
     * @return [type] [description]
     */
    public function get_configurations()
    {

        $this->scan_folder_configuration( $this->getPathFolderConfiguration() );
echo 'test';
        /**
         *  Change Theme by uri
         */
        $request_uri =  $_SERVER["REQUEST_URI"];
        $core = \Chocolatine\get_core();
        if (  0 === strpos( $request_uri, $this->get_configuration( 'main' )['admin_route'] ) ) {
            $this->container['main']['theme'] = $this->get_configuration( 'main' )['theme_admin'];
            $core->etat = "admin";
        }
        if ( 0 === strpos( $request_uri, $this->get_configuration( 'main' )['api_route'] ) ){
            $this->container['main']['theme'] = $this->get_configuration( 'main' )['theme_api'];
            $core->etat = "api";
        }
        /**
         * Scan The Folder theme
         */
        $path_theme =  \Chocolatine\get_folder() . "/themes/" . $this->get_configuration( 'main' )['theme'] . "/configuration";

        if ( is_dir( $path_theme ) ) {
          $this->scan_folder_configuration( $path_theme  );
        }

    }
    public function scan_folder_configuration( $path_folder ){

        $list_files = \Chocolatine\scanfolder( $path_folder );

        foreach ( $list_files as $file) {

            $this->add_configuration(
                basename( $file, '.php'),
                require $path_folder .'/'. $file
            );

        }

    }
    /**
     * Return configuration
     * @param  string the name of data
     * @return mixed return false is empty or value
     */
    public function get_configuration( $name )
    {
        if ( !empty( $this->container[$name] ) ) {
            return $this->container[$name];
        }
        else{
            return false;
        }
    }
    /**
     * Return the path folder configuration
     * @var string
     */
    public function getPathFolderConfiguration()
    {
        return \Chocolatine\get_folder() .  "/config";
    }
}
