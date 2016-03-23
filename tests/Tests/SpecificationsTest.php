<?php

namespace Alchemy\Pipeline\Tests;

use Alchemy\Pipeline\Specification;
use Alchemy\Pipeline\Specifications;

class SpecificationsTest extends \PHPUnit_Framework_TestCase
{

    public function testAndSpecsReturnsAndSpecification()
    {
        $first = $this->prophesize(Specification::class)->reveal();
        $other = $this->prophesize(Specification::class)->reveal();

        $result = Specifications::andSpecs($first, $other);

        $this->assertInstanceOf(Specification\AndSpecification::class, $result);
    }

    public function testOrSpecsReturnsOrSpecification()
    {
        $first = $this->prophesize(Specification::class)->reveal();
        $other = $this->prophesize(Specification::class)->reveal();

        $result = Specifications::orSpecs($first, $other);

        $this->assertInstanceOf(Specification\OrSpecification::class, $result);
    }

    public function testNotSpecReturnsNotSpecification()
    {
        $specification = $this->prophesize(Specification::class)->reveal();

        $result = Specifications::notSpec($specification);

        $this->assertInstanceOf(Specification\NotSpecification::class, $result);
    }
}
