<?php

namespace Foxworth42\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ThirdController
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function respond(): Response
    {
        return new Response("Some Other content");
    }
}
