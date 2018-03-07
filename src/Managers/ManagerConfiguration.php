<?php

namespace Chocolatine\Managers;

use Chocolatine\Component\Manager;
use Chocolatine\Helper;

class ManagerConfiguration extends Manager
{
    public function __construct()
    {
        $this->getConfigurations();
    }
    /**
     * Add or Merge configuration
     * @param string $name name of key
     * @param mixed  $args contain of configuration
     */
    public function addConfiguration($name, $args)
    {
        if (empty($this->container[$name])) {
            $this->container[$name] = $args;
        } else {
            $this->container[$name] = array_merge($this->container[$name],  $args);
        }
    }
    /**
     * Get all  files in folder configuration and stock the values
     */
    public function getConfigurations()
    {
        // Scan Self Folder Configuration
        $this->scanFolderConfiguration($this->getPathFolderConfiguration());
        /**
         * Scan The Folder theme
         */
        $pathConfigFolder = Helper::get_core()->getPathApplication() . "/Config";

        if (is_dir($pathConfigFolder)) {
            $this->scanFolderConfiguration($pathConfigFolder );
        }

    }
    /**
     * Scan a folder for get files of configurations
     * @param  string $pathFolder Path of Folder Configuration
     */
    public function scanFolderConfiguration($pathFolder){

        $listFile = Helper::scanfolder($pathFolder);

        foreach ($listFile as $nameFile) {

            $pathFile = $pathFolder .'/'. $nameFile;
            $pathInfo = pathinfo($pathFile);

            // Look is file is json or file php
            if ($pathInfo['extension'] == 'json') {
                $data = \json_decode(\file_get_contents($pathFile), 1);
            } else {
                $data = require $pathFile;
            }

            $this->addConfiguration(
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
    public function getConfiguration($name)
    {
        if (!empty($this->container[$name])) {
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
