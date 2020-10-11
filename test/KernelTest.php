<?php

namespace Foxworth42\Tests;

use Foxworth42\Kernel;
use Foxworth42\Routes;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class KernelTest extends TestCase
{
    /**
     * @test
     */
    public function shouldRespondToRequestSuccessfully()
    {
        // Arrange
        $mockRoutes = new Routes();
        $mockRequest = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $mockRequest->method("getPathInfo")->willReturn("/path/thing");
        $testKernel = new Kernel($mockRoutes, $mockRequest);

        // Act
        $response = $testKernel->run();

        // Assert
        $this->assertSame("Some text: Some Test Text!", $response->getContent());
        $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function shouldRespondWith404IfRouteNotFound()
    {
        // Arrange
        $mockRoutes = new Routes();
        $mockRequest = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $mockRequest->method("getPathInfo")->willReturn("/unknown/path");
        $testKernel = new Kernel($mockRoutes, $mockRequest);

        // Act
        $response = $testKernel->run();

        // Assert
        $this->assertStringContainsString("No routes found for", $response->getContent());
        $this->assertSame(404, $response->getStatusCode());
    }
}
