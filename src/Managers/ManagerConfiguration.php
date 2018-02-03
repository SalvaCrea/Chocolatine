<?php

namespace Chocolatine\Managers;

use Chocolatine\Pattern\Manager;
use Chocolatine\Helper;

class ManagerConfiguration extends Manager
{
    public $name = 'configuration';

    public function __construct()
    {
        $this->get_configurations();
    }
    /**
     * Add or Merge configuration
     * @param string $name name of key
     * @param mixed  $args contain of configuration
     */
    public function add_configuration( $name, $args )
    {
        if ( empty( $this->container[$name] ) ) {
            $this->container[$name] = $args;
        } else {
            $this->container[$name] = array_merge( $this->container[$name],  $args);
        }
    }
    /**
     * Get all  files in folder configuration and stock the values
     */
    public function get_configurations()
    {
        // Scan Self Folder Configuration
        $this->scan_folder_configuration( $this->getPathFolderConfiguration() );
        /**
         * Scan The Folder theme
         */
        $pathConfigFolder =  Helper::get_core()->getPathApplication() . "/Config";

        if ( is_dir( $pathConfigFolder ) ) {
            $this->scan_folder_configuration( $pathConfigFolder  );
        }

    }
    /**
     * Scan a folder for get files of configurations
     * @param  string $pathFolder Path of Folder Configuration
     */
    public function scan_folder_configuration( $pathFolder ){

        $listFile = Helper::scanfolder( $pathFolder );

        foreach ( $listFile as $nameFile ) {

            $pathFile = $pathFolder .'/'. $nameFile;
            $pathInfo = pathinfo( $pathFile );

            // Look is file is json or file php
            if ( $pathInfo['extension'] == 'json' ) {
                $data = \json_decode( \file_get_contents( $pathFile ), 1 );
            } else {
                $data = require $pathFile;
            }

            $this->add_configuration(
                $pathInfo['filename'],
                $data
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
        return Helper::get_folder() .  "/src/Config";
    }
}
