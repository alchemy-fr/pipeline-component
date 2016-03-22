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

use Alchemy\Pipeline\Element\IfTrueElement;
use Alchemy\Pipeline\PipelineElement;
use Alchemy\Pipeline\Specification;
use Alchemy\Resource\Resource;

class IfTrueElementTest extends \PHPUnit_Framework_TestCase
{

    public function testResourceIsProcessedWhenSpecificationIsNotSatisfied()
    {
        $resource = $this->prophesize(Resource::class)->reveal();
        $expected = $this->prophesize(Resource::class)->reveal();
        $specification = $this->prophesize(Specification::class);
        $nestedElement = $this->prophesize(PipelineElement::class);

        $specification->isSatisfiedBy($resource)->willReturn(true);
        $nestedElement->execute($resource)->willReturn($expected);

        $element = new IfTrueElement($specification->reveal(), $nestedElement->reveal());

        $result = $element->execute($resource);

        $this->assertSame($expected, $result);
    }

    public function testResourceIsNotProcessedWhenSpecificationIsNotSatisfied()
    {
        $resource = $this->prophesize(Resource::class)->reveal();
        $unexpected = $this->prophesize(Resource::class)->reveal();
        $specification = $this->prophesize(Specification::class);
        $nestedElement = $this->prophesize(PipelineElement::class);

        $specification->isSatisfiedBy($resource)->willReturn(false);
        $nestedElement->execute($resource)->willReturn($unexpected);

        $element = new IfTrueElement($specification->reveal(), $nestedElement->reveal());

        $result = $element->execute($resource);

        $this->assertSame($resource, $result);
    }
}
