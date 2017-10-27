<?php

namespace sp_framework\Services;

class Renderer extends \sp_framework\Pattern\Service{
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

      if ( \sp_framework\is_dev() ) {
        $configTwig += array(
            'cache' => CACHE,
        );
      }
      else{
        $configTwig += array(
            'cache' => false,
        );
      }

      $loader = new \Twig_Loader_Filesystem( \sp_framework\get_path_theme() . '/templates' );

      return self::$twig = new \Twig_Environment( $loader, $configTwig );
    }
    /**
     * Use twig for make a render
     * @param  string $template_name  Name of template || Path Template
     * @param  array  $param          Param for twig render
     * @return string                 The template html
     */
    public function renderer( string $template_name, array $param ){
        return self::$twig->render( $template_name, $param );
    }
    /**
     * Add a global variable in twig
     * @param string $name  name of global
     * @param mixed  $value value of global
     */
    public function add_global( string $name, mixed $value ){
        self::$twig->addGlobal( $name , $value );
    }
}
