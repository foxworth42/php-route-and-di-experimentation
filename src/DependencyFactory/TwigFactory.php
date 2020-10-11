<?php

namespace Foxworth42\DependencyFactory;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigFactory
{
    public static function getInstance()
    {
        $loader = new FilesystemLoader(__DIR__ . "/../../templates");
        $twig = new Environment($loader, [
            'cache' => __DIR__ . "/../../var/cache/twig",
        ]);

        return $twig;
    }
}