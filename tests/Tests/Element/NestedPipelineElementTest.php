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

use Alchemy\Pipeline\Element\NestedPipelineElement;
use Alchemy\Pipeline\Pipeline;
use Alchemy\Resource\Resource;

class NestedPipelineElementTest extends \PHPUnit_Framework_TestCase
{

    public function testElementReturnsNestedPipelineResult()
    {
        $resource = $this->prophesize(Resource::class);
        $expected = $this->prophesize(Resource::class);
        $pipeline = $this->prophesize(Pipeline::class);

        $pipeline->process($resource->reveal())->willReturn($expected->reveal());

        $element = new NestedPipelineElement($pipeline->reveal());

        $this->assertSame($expected->reveal(), $element->execute($resource->reveal()));
    }
}
