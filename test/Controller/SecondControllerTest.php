<?php

namespace Foxworth42\Tests\Controller;

use Foxworth42\Controller\SecondController;
use Foxworth42\Database;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class SecondControllerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldRespondWithSomething()
    {
        // Arrange
        $mockRequest = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $mockDatabase = $this->getMockBuilder(Database::class)->disableOriginalConstructor()->getMock();
        $mockDatabase->method("something")->willReturn("Some Text");
        $testController = new SecondController();
        // Act
        $response = $testController->respond($mockRequest, $mockDatabase);
        // Assert
        $this->assertEquals("Some Text", $response->getContent());
    }
}
