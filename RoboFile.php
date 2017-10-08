<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    function hello($world)
    {
        $this->say("Hello, $world");
    }
    function install(){
        $this->taskCopyDir(['_theme' => '../../themes/sp-framework-theme'])->run();
    }
}
