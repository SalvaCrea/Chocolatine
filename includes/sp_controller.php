<?php
namespace sp_framework;

class sp_controller
{
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

        $this->list_route []= $args;
    }
    /**
     * [add_listenner function for add listernner]
     * @param [type] $args [description]
     */
    public static function add_listenner( $args )
    {

        $args_default = array(
          'module' => '',
          'method' => '',
          'post_type' => '',
          'post_id' => '',
        );

        $args = array_merge( $args_default, $args);

        $args = array_filter( $args );

        $this->list_listenner []= $args;

    }
}
