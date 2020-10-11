<?php

namespace Foxworth42\Tests\DependencyFactory;

use Foxworth42\Database;
use Foxworth42\DependencyFactory\DatabaseFactory;
use PHPUnit\Framework\TestCase;

class DatabaseFactoryTest extends TestCase
{
    use FactoryAssertionTrait;

    /**
     * @test
     */
    public function shouldReturnInstnceOfDatabase()
    {
        $this->doFactoryTest(DatabaseFactory::class, Database::class);
    }
}
