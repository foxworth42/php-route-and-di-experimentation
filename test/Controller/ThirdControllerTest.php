<?php

namespace Foxworth42\Tests\Controller;

use Foxworth42\Controller\ThirdController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ThirdControllerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldRespondWithSomeContent()
    {
        // Arrange
        $mockRequest = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $testController = new ThirdController($mockRequest);
        // Act
        $response = $testController->respond();
        // Assert
        $this->assertEquals("Some Other content", $response->getContent());
    }
}
