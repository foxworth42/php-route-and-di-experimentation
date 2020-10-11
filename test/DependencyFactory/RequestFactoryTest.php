<?php

namespace Foxworth42\Tests\DependencyFactory;

use Foxworth42\DependencyFactory\RequestFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class RequestFactoryTest extends TestCase
{
    use FactoryAssertionTrait;

    /**
     * @test
     */
    public function shouldReturnInstnceOfRequest()
    {
        $this->doFactoryTest(RequestFactory::class, Request::class);
    }
}