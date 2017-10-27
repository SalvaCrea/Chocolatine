<?php
namespace sp_framework;

class ManagerListenner extends Manager
{
    public $name = 'asset';
    /**
     * [$list_listenner contain all listernner]
     * @var array
     */
    public static $list_listenner = array();
    /**
     * [$list_route the list of the route]
     * @var array
     */
    public static $list_route = array();
    /**
     * [add_route this for add route]
     * @param [array] $args [array contain info]
     */
    public static function add_route( $args )
    {
        $args_default = array(
          'module' => '',
          'method' => '',
          'route' => ''
        );

        $args = array_merge( $args_default, $args);

        self::$list_route []= $args;

    }
    /**
     * [use_route walk the list]
     */
    private static function use_route()
    {
        if ( empty( self::$list_route ) )
          return false;

        foreach (self::$list_route as $key => $route) {
            self::apply_route( $route );
        }
    }
    /**
     * [apply_route apply the route]
     * @param  [array] $route [description]
     */
    private static function apply_route( $route )
    {

    }
    /**
     * [add_listenner function for add listernner]
     * @param [type] $args [description]
     */
    public static function add_listenner( $args )
    {

        $args_default = array(
          // the slug of the module
          'module' => '',
          // the method of module
          'method' => '',

          'post_type' => '',
          'post_id' => '',
          'post_name' => ''
        );

        $args = array_merge( $args_default, $args);

        $args = array_filter( $args );

        self::$list_listenner []= $args;

    }
    /**
     * [use_route walk the list]
     */
    private static function use_listenner()
    {
      if ( empty( self::$list_listenner ) )
        return false;

        global $post;

        foreach (self::$list_listenner as $key => $listenner) {

            foreach ( $listenner as $key => $value) {
                if ( $post->{$key} == $value ) {
                  self::apply_listenner( $listenner );
                }
            }

        }
      return true;
    }
    /*
    * [apply_route apply the listenner]
    * @param  [array] $listenner [description]
    */
    private static function apply_listenner( $listenner )
    {

        $module = sp_get_module( $listenner['module'] );

        $module->{$listenner['method']}();
    }
    /**
     * [start description]
     */
    public static function start()
    {

        self::use_route();
        self::use_listenner();

    }
}
