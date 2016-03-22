<?php

/*
 * This file is part of alchemy/pipeline-component.
 *
 * (c) Alchemy <info@alchemy.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alchemy\Pipeline\Tests\Element;

use Alchemy\Pipeline\Element\IfThenElseElement;
use Alchemy\Pipeline\PipelineElement;
use Alchemy\Pipeline\Specification;
use Alchemy\Resource\Resource;

class IfThenElseElementTest extends \PHPUnit_Framework_TestCase
{

    public function testTrueElementIsExecutedWhenSpecificationIsSatisfied()
    {
        $resource = $this->prophesize(Resource::class)->reveal();
        $expected = $this->prophesize(Resource::class)->reveal();
        $unexpected = $this->prophesize(Resource::class)->reveal();

        $specification = $this->prophesize(Specification::class);
        $trueElement = $this->prophesize(PipelineElement::class);
        $falseElement = $this->prophesize(PipelineElement::class);

        $specification->isSatisfiedBy($resource)->willReturn(true);
        $trueElement->execute($resource)->willReturn($expected);
        $falseElement->execute($resource)->willReturn($unexpected);

        $element = new IfThenElseElement($specification->reveal(), $trueElement->reveal(), $falseElement->reveal());

        $result = $element->execute($resource);

        $this->assertSame($expected, $result);
    }

    public function testFalseElementIsExecutedWhenSpecificationIsNotSatisfied()
    {
        $resource = $this->prophesize(Resource::class)->reveal();
        $expected = $this->prophesize(Resource::class)->reveal();
        $unexpected = $this->prophesize(Resource::class)->reveal();

        $specification = $this->prophesize(Specification::class);
        $trueElement = $this->prophesize(PipelineElement::class);
        $falseElement = $this->prophesize(PipelineElement::class);

        $specification->isSatisfiedBy($resource)->willReturn(false);
        $trueElement->execute($resource)->willReturn($unexpected);
        $falseElement->execute($resource)->willReturn($expected);

        $element = new IfThenElseElement($specification->reveal(), $trueElement->reveal(), $falseElement->reveal());

        $result = $element->execute($resource);

        $this->assertSame($expected, $result);
    }
}
