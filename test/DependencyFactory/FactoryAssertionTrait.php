<?php

namespace Foxworth42\Tests\DependencyFactory;

trait FactoryAssertionTrait
{
    public function doFactoryTest($factory, $expectedClass)
    {
        // Arrange
        // Act
        $createdClass = $factory::create();
        // Assert
        $this->assertInstanceOf($expectedClass, $createdClass);
    }
}
