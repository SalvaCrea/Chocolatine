<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

namespace sp_framework\Services;

use Medoo\Medoo;

class Router extends \sp_framework\Pattern\Service{

  public $name = 'Router';

  /**
   * Requete http
   * @var array
   */
  public $requete;
  /**
   * Response Http
   * @var array
   */
  public $response;
  /**
   * Argument in url or post
   * @var array
   */
  public $args;
  /**
   * List routes
   * @var array
   */
  public $routes = array();
  public function __construct(){

      $config = ['settings' => [
          'addContentLengthHeader' => false,
          'displayErrorDetails' => true
      ]];

      $this->router =  new \Slim\App( $config );
  }
  // use for declarate all routes
  public function declare_routes(){
        $this->routes = \sp_framework\get_configuration( 'routes' );
        $view_manager = \sp_framework\get_manager('view');

        foreach ( $this->routes as $key => $current_route) {

          if ( false !== $view = $view_manager->get_view( $current_route['view'] ) ) {
              if ( isset (  $current_route['method'] ) ) {
                $method = $current_route['method'];
              }else{
                $method = 'main';
              }

              $this->router->map(['GET', 'POST'],  $current_route['route'] ,function ($request, $response, $args) {

                  $router = \sp_framework\get_service( 'Router' );
                  return $router->controller( $request, $response, $args );

              });

          }

        }

  }
  public function use_routes(){
        $this->router->run();
  }
  public function controller( $request, $response, $arg = [] ){

        $route = $request->getAttribute('route');
        $this->current_pattern = $route->getPattern();

        $name = $route->getName();
        $groups = $route->getGroups();
        $methods = $route->getMethods();
        $arguments = $route->getArguments();

        $uri = $request->getUri();
        $path = $uri->getPath();

        \sp_framework\dump( $path );
        $this->request = $request;
        $this->response = $response;
        $this->arg = $arg;

        return $response->getBody()->write("Hello, qsdqsdqsd");

  }
}
