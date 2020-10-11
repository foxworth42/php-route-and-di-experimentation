<?php

namespace Foxworth42;

use Foxworth42\Controller\FirstController;
use Foxworth42\Controller\SecondController;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
    private $routes;
    public function __construct()
    {
        $this->initRoutes();
    }

    private function initRoutes()
    {
        $this->routes = new RouteCollection();
        $this->addRoute("/path/thing", FirstController::class, "respondToPath", ["Request"]);
        $this->addRoute("/second/path", SecondController::class, "respond", ["Request", "Database"]);
    }

    private function addRoute($path, $class, $handler, $dependencyInjection = [])
    {
        $this->routes->add($handler, new Route($path, ['_controller' => $class, "dependencyInjection" => $dependencyInjection]));
    }

    public function getRouteHandler($route)
    {
        $context = new RequestContext();
        $matcher = new UrlMatcher($this->routes, $context);

        $parameters = $matcher->match($route);

        return $parameters;
    }
}
