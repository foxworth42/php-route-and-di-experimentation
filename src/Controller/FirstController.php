<?php

namespace Foxworth42\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FirstController
{
    public function respondToPath(Request $request): Response
    {
        var_dump($request);
        return new Response("Something");
    }
}