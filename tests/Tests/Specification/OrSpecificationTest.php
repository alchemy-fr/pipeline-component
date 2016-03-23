<?php

namespace Alchemy\Pipeline\Tests\Specification;

use Alchemy\Pipeline\Specification;
use Alchemy\Resource\Resource;

class OrSpecificationTest extends \PHPUnit_Framework_TestCase
{

    public function getOrTruthTable()
    {
        return [
            [ false, false, false ],
            [ true, false, true ],
            [ false, true, true ],
            [ true, true, true ]
        ];
    }

    /**
     * @dataProvider getOrTruthTable
     */
    public function testOrSpecificationIsCompliantWithOrTruthTable($lhsResult, $rhsResult, $orResult)
    {
        $lhs = $this->prophesize(Specification::class);
        $rhs = $this->prophesize(Specification::class);
        $resource = $this->prophesize(Resource::class)->reveal();

        $lhs->isSatisfiedBy($resource)->willReturn($lhsResult);
        $rhs->isSatisfiedBy($resource)->willReturn($rhsResult);

        $orSpecification = new Specification\OrSpecification($lhs->reveal(), $rhs->reveal());

        $result = $orSpecification->isSatisfiedBy($resource);

        $this->assertEquals($orResult, $result);
    }
}
