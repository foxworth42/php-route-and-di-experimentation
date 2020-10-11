<?php

namespace Foxworth42\Controller;

use Foxworth42\Database;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecondController
{
    public function respond(Request $request, Database $database): Response
    {
        return new Response($database->something());
    }
}
