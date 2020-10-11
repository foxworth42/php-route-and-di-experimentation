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
        $testController = new FirstController();
        $mockTwig = TwigFactory::getInstance();
        $mockRequest = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        // Act
        $result = $testController->respondToPath($mockRequest, $mockTwig);
        // Assert
        $this->assertEquals("Some text: Some Test Text!", $result->getContent());
    }
}
