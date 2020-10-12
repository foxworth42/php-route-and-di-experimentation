<?php

namespace Foxworth42;

use Foxworth42\DependencyFactory\TwigFactory;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
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
            $containerBuilder = new ContainerBuilder();
            (new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . "/../config")))->load("services.yaml");
            $containerBuilder->compile(true);

            $requestHandlerConfig = $this->routes->getRouteHandler($this->request->getPathInfo());

            $controller = $containerBuilder->get($requestHandlerConfig["_controller"]);

            $response = $controller->{$requestHandlerConfig["_route"]}();
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
}
