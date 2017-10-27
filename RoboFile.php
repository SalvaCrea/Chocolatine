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
<<<<<<< HEAD
        // $this->taskCopyDir(['_theme/wp' => '../../themes/sp-framework-theme'])->run();
=======
        $this->taskCopyDir(['_theme/wordpress' => '../../themes/sp-framework-theme'])->run();
>>>>>>> master
    }
    public function server(){

      $this->taskExecStack()
<<<<<<< HEAD
       ->stopOnFail()
=======
       ->stopOnFail() 
>>>>>>> master
       ->exec('node gulpfile.js server')
       ->run();

    }
}
