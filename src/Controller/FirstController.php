<?php

namespace Foxworth42\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FirstController
{
    public function respondToPath(Request $request, $twig): Response
    {
        return new Response($twig->render("index.twig", ["testText" => "Some Test Text!"]));
    }
}