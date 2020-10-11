<?php

namespace Foxworth42;

use Foxworth42\DependencyFactory\TwigFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Kernel
{
    private $routes;
    private $request;
    public function __construct(Routes $routes, Request $request)
    {
        $this->routes = $routes;
        $this->request = $request;
    }

    public function run(): Response
    {
        try {
            $requestHandlerConfig = $this->routes->getRouteHandler($this->request->getPathInfo());
            $response = $this->handleRequest(
                $requestHandlerConfig["_controller"],
                $requestHandlerConfig["_route"],
                $this->getDependencies($requestHandlerConfig["dependencyInjection"])
            );
        } catch (\Exception $error) {
            $response = new Response($error->getMessage());
            if ($error instanceof ResourceNotFoundException) {
                $response = new Response(TwigFactory::getInstance()->render("404.twig", [
                    "message" => $error->getMessage()
                ]), 404);
            }
        }

        return $response;
    }

    private function getDependencies(array $dependencyInjectionConfig): array
    {
        $params = [];
        if ($dependencyInjectionConfig !== []) {
            foreach ($dependencyInjectionConfig as $dependency) {
                array_push($params, call_user_func([
                    sprintf("Foxworth42\DependencyFactory\%sFactory", $dependency),
                    "getInstance"
                ]));
            }
        }
        return $params;
    }

    private function handleRequest(string $handlerClass, string $handlerMethod, array $dependencies): Response
    {
        $response = call_user_func_array([
            new $handlerClass(),
            $handlerMethod
        ], $dependencies);
        return $response;
    }
}
