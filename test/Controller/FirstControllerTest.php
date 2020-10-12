<?php

namespace Foxworth42\Tests\Controller;

use Foxworth42\Controller\FirstController;
use Foxworth42\DependencyFactory\TwigFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class FirstControllerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnSomething()
    {
        // Arrange
        $mockTwig = new TwigFactory();
        $mockRequest = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $testController = new FirstController($mockRequest, $mockTwig);
        // Act
        $result = $testController->respondToPath();
        // Assert
        $this->assertEquals("Some text: Some Test Text!", $result->getContent());
    }
}
