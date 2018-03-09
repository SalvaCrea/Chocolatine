<?php
namespace Chocolatine\Component\Service;

use Chocolatine\Component\Service;

use Chocolatine\Helper;

abstract class Router extends Service
{
    /**
     * Current Route
     * @var array
     */
    public $currentRoute;
    public function __construct()
    {
        $this->getRoutes();
        $this->useRoute();
    }
    public function getRoutes()
    {
        return Helper::get_configuration('routes');
    }
    public function useRoute()
    {
        $this->findRoute();

        if ( $this->currentRoute != false ) {
            $controller = new $this->currentRoute['controller'];
            call_user_func(array($controller, $this->currentRoute['method']));
        }
    }
    public function findRoute()
    {
        foreach ($this->getRoutes() as $route) {
            if ( !empty($route['postType']) && $route['postType'] == $post->post_type ) {
              return $this->currentRoute = $route;
            }
        }
        return false;
    }
}