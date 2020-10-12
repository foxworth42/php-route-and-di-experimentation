<?php

namespace Foxworth42\Controller;

use Foxworth42\DependencyFactory\TwigFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class FirstController
{
    private $request;
    private $twig;

    public function __construct(Request $request, TwigFactory $twig)
    {
        $this->request = $request;
        $this->twig = $twig::getInstance();
    }

    public function respondToPath(): Response
    {
        return new Response($this->twig->render("index.twig", ["testText" => "Some Test Text!"]));
    }
}
