<?php

namespace Foxworth42\Tests;

use Foxworth42\Routes;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class RoutesTest extends TestCase
{
    /**
     * @test
     */
    public function shouldInstantiateSuccessfully()
    {
        // Arrange
        $testRoutes = new Routes();
        // Act
        // Assert
        $this->assertNotNull($testRoutes);
    }

    /**
     * @test
     */
    public function shouldReturnRouteHandlerInformation()
    {
        // Arrange
        $testRoutes = new Routes();
        // Act
        $result = $testRoutes->getRouteHandler("/path/thing");
        // Assert
        $this->assertSame("Foxworth42\Controller\FirstController", $result["_controller"]);
        $this->assertSame("respondToPath", $result["_route"]);
        $this->assertSame(["Request", "Twig"], $result["dependencyInjection"]);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfNoRouteFound()
    {
        // Arrange
        $testRoutes = new Routes();
        $this->expectException(ResourceNotFoundException::class);
        // Act
        $result = $testRoutes->getRouteHandler("/unknown/route");
        // Assert
    }
}
