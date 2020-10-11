<?php

namespace Foxworth42\DependencyFactory;

use Symfony\Component\HttpFoundation\Request;

class RequestFactory
{
    public static function getInstance(): Request
    {
        return Request::createFromGlobals();
    }
}