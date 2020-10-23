<?php

namespace Foxworth42\DependencyFactory;

use Symfony\Component\HttpFoundation\Request;

class RequestFactory
{
    public static function create(): Request
    {
        return Request::createFromGlobals();
    }
}
