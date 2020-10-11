<?php

namespace Foxworth42\DependencyFactory;

use Foxworth42\Database;

class DatabaseFactory
{
    public static function getInstance(): Database
    {
        return new Database();
    }
}
