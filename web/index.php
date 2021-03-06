<?php

namespace Foxworth42;

use Foxworth42\DependencyFactory\RequestFactory;

include_once("../bootstrap.php");

$kernel = new Kernel(new Routes(), RequestFactory::create());

$response = $kernel->run();

$response->send();
