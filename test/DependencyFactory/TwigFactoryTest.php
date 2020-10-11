<?php

namespace Foxworth42\Tests\DependencyFactory;

use Foxworth42\DependencyFactory\TwigFactory;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class TwigFactoryTest extends TestCase
{
    use FactoryAssertionTrait;
    
    /**
     * @test
     */
    public function shouldReturnInstnceOfTwig()
    {
        $this->doFactoryTest(TwigFactory::class, Environment::class);
    }
}