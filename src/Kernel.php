<?php

namespace Foxworth42;

use Foxworth42\DependencyFactory\RequestFactory;
use Foxworth42\DependencyFactory\TwigFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Kernel
{
    private $routes;
    private $request;
    public function __construct()
    {
        $this->routes = new Routes();
        $this->request= RequestFactory::getInstance();
    }

    public function run()
    {
        try {
            $requestHandlerConfig = $this->routes->getRouteHandler($this->request->getPathInfo());
            $requestHandler = new $requestHandlerConfig["_controller"]();
            $dependencies = $this->getDependencies($requestHandlerConfig["dependencyInjection"]);

            $response = call_user_func_array([$requestHandler, $requestHandlerConfig["_route"]], $dependencies);
        } catch (\Exception $error) {
            $response = new Response($error->getMessage());
            if($error instanceof ResourceNotFoundException) {
                $response = new Response(TwigFactory::getInstance()->render("404.twig", ["message" => $error->getMessage()]), 404);
            }
        }

        $response->send();
    }

    private function getDependencies($dependencyInjection): array
    {
        $params = [];
        if ($dependencyInjection !== []) {
            foreach ($dependencyInjection as $dependency) {
                array_push($params, call_user_func([sprintf("Foxworth42\DependencyFactory\%sFactory", $dependency), "getInstance"]));
            }
        }
        return $params;
    }
}