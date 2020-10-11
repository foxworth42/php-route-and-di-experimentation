<?php

namespace Foxworth42\Tests;

use Foxworth42\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnSomething()
    {
        // Arrange
        $testDb = new Database();

        // Act
        $result = $testDb->something();

        // Assert
        $this->assertSame("We're returning something from the database!", $result);
    }
}
