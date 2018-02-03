<?php

namespace Chocolatine\Services;

use Chocolatine\Helper;

class Renderer extends \Chocolatine\Pattern\Service{
    public $name = 'renderer';
    /**
     * Container of instance twig
     * @var object
     */
    public static $twig;

    public function __construct(){
        $this->init();
    }
    /**
     *  Instance Twig
     * @return object return the instance of twig
     */
    public function init(){
        $configTwig = array();

        if ( Helper::is_dev() ) {
          $configTwig += array(
              'cache' => CACHE,
          );
        }
        else{
          $configTwig += array(
              'cache' => false,
          );
        }

        $loader = new \Twig_Loader_Filesystem( Helper::get_path_app() . '/templates' );

        $this->twig_fast = new \Twig_Environment(new \Twig_Loader_String);

        return self::$twig = new \Twig_Environment( $loader, $configTwig );
    }
    /**
     * Use twig for make a render
     * @param  string $template_name  Name of template || Path Template
     * @param  array  $param          Param for twig render
     * @return string                 The template html
     */
    public function renderer( $template_name, array $param ){
        return self::$twig->render( $template_name, $param );
    }
    public function fast_render( $template_string, array $args = [] ){
        return $this->twig_fast->render( $template_string, $args );
    }
    /**
     * Add a global variable in twig
     * @param string $name  name of global
     * @param mixed  $value value of global
     */
    public function add_global( $name, $value ){
        self::$twig->addGlobal( $name , $value );
    }
}
