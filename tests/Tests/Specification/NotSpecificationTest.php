<?php

namespace Alchemy\Pipeline\Tests\Specification;

use Alchemy\Pipeline\Specification;
use Alchemy\Resource\Resource;

class NotSpecificationTest extends \PHPUnit_Framework_TestCase
{

    public function testSpecificationNegatesTrueResult()
    {
        $resource = $this->prophesize(Resource::class)->reveal();
        $specification = $this->prophesize(Specification::class);

        $specification->isSatisfiedBy($resource)->willReturn(true);

        $notSpecification = new Specification\NotSpecification($specification->reveal());

        $this->assertFalse(
            $notSpecification->isSatisfiedBy($resource),
            '`not` specification should negate result of wrapped specification.'
        );
    }

    public function testSpecificationNegatesFalseResult()
    {
        $resource = $this->prophesize(Resource::class)->reveal();
        $specification = $this->prophesize(Specification::class);

        $specification->isSatisfiedBy($resource)->willReturn(false);

        $notSpecification = new Specification\NotSpecification($specification->reveal());

        $this->assertTrue(
            $notSpecification->isSatisfiedBy($resource),
            '`not` specification should negate result of wrapped specification.'
        );
    }
}
