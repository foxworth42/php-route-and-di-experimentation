<?php

namespace Foxworth42\Controller;

use Foxworth42\Database;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecondController
{
    private $request;
    private $database;

    public function __construct(Request $request, Database $database)
    {
        $this->request = $request;
        $this->database = $database;
    }

    public function respond(): Response
    {
        return new Response($this->database->something());
    }
}
