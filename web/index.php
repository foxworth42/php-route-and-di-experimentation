<?php

namespace Foxworth42;

use Foxworth42\DependencyFactory\RequestFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

include_once("../bootstrap.php");

$app = [
    "request" => RequestFactory::getInstance(),
    "routes" => new Routes()
];

try {
    $handlerConfig = $app["routes"]->getRouteHandler($app["request"]->getPathInfo());
    $handler = new $handlerConfig["_controller"]();

    $params = [];
    if($handlerConfig["dependencyInjection"] !== []) {
        foreach($handlerConfig["dependencyInjection"] as $dependency) {
            array_push($params, call_user_func([sprintf("Foxworth42\DependencyFactory\%sFactory",$dependency), "getInstance"]));
        }
    }

    $response = call_user_func_array([$handler, $handlerConfig["_route"]], $params);

} catch (\Exception $error) {
    $response = new Response($error->getMessage());
    if($error instanceof ResourceNotFoundException) {
        $response->setStatusCode(404);
    }
}

$response->send();
