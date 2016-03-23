<?php

namespace Alchemy\Pipeline\Tests\Specification;

use Alchemy\Pipeline\Specification;
use Alchemy\Resource\Resource;

class AndSpecificationTest extends \PHPUnit_Framework_TestCase
{

    public function getAndTruthTable()
    {
        return [
            [ false, false, false ],
            [ true, false, false ],
            [ false, true, false ],
            [ true, true, true ]
        ];
    }

    /**
     * @dataProvider getAndTruthTable
     */
    public function testAndSpecificationIsCompliantWithAndTruthTable($lhsResult, $rhsResult, $andResult)
    {
        $lhs = $this->prophesize(Specification::class);
        $rhs = $this->prophesize(Specification::class);

        $resource = $this->prophesize(Resource::class)->reveal();

        $lhs->isSatisfiedBy($resource)->willReturn($lhsResult);
        $rhs->isSatisfiedBy($resource)->willReturn($rhsResult);

        $orSpecification = new Specification\AndSpecification($lhs->reveal(), $rhs->reveal());

        $result = $orSpecification->isSatisfiedBy($resource);

        $this->assertEquals($andResult, $result);
    }
}
