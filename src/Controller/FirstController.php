<?php

namespace Foxworth42\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class FirstController
{
    public function respondToPath(Request $request, Environment $twig): Response
    {
        return new Response($twig->render("index.twig", ["testText" => "Some Test Text!"]));
    }
}
