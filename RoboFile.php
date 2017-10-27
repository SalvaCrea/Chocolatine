<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    public function __construct(){
        require "console/Console.php";
    }
    public function install(){
        // $this->taskCopyDir(['_theme/wp' => '../../themes/sp-framework-theme'])->run();
    }
    public function server(){

      $this->taskExecStack()
       ->stopOnFail()
       ->exec('node gulpfile.js server')
       ->run();

    }
}
