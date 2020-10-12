<?php

namespace Foxworth42;

use Foxworth42\Controller\FirstController;
use Foxworth42\Controller\SecondController;
use Foxworth42\Controller\ThirdController;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
    /** @var RouteCollection */
    private $routes;

    public function __construct()
    {
        $this->initRoutes();
    }

    private function initRoutes(): void
    {
        $this->routes = new RouteCollection();
        $this->addRoute("/path/thing", FirstController::class, "respondToPath");
        $this->addRoute("/second/path", SecondController::class, "respond");
        $this->addRoute("/third/path", ThirdController::class, "respond");
    }

    private function addRoute(string $path, string $class, string $handler): void
    {
        $this->routes->add($handler, new Route($path, [
            '_controller' => $class
        ]));
    }

    public function getRouteHandler(string $route): array
    {
        $context = new RequestContext();
        $matcher = new UrlMatcher($this->routes, $context);

        $parameters = $matcher->match($route);

        return $parameters;
    }
}
