<?php

/*
 * This file is part of alchemy/pipeline-component.
 *
 * (c) Alchemy <info@alchemy.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alchemy\Pipeline\Tests\Pipeline;

use Alchemy\Pipeline\Pipeline\ForwardPipeline;
use Alchemy\Pipeline\PipelineElement;
use Alchemy\Resource\Resource;
use Prophecy\Argument;

class ForwardPipelineTest extends \PHPUnit_Framework_TestCase
{

    public function testPipelineExecutesRegisteredStep()
    {
        $resource = $this->prophesize(Resource::class);
        $expected = $this->prophesize(Resource::class);
        $step = $this->prophesize(PipelineElement::class);

        $step->execute($resource->reveal())->willReturn($expected->reveal());

        $pipeline = new ForwardPipeline();

        $pipeline->addStep($step->reveal());

        $this->assertSame($expected->reveal(), $pipeline->process($resource->reveal()));
    }

    public function testPipelineExecutesMultipleRegisteredSteps()
    {
        $resource = $this->prophesize(Resource::class);
        $intermediate = $this->prophesize(Resource::class);
        $expected = $this->prophesize(Resource::class);

        $step = $this->prophesize(PipelineElement::class);
        $step->execute($resource->reveal())->willReturn($intermediate->reveal());

        $nextStep = $this->prophesize(PipelineElement::class);
        $nextStep->execute($intermediate->reveal())->willReturn($expected->reveal());

        $pipeline = new ForwardPipeline();

        $pipeline->addStep($step->reveal());
        $pipeline->addStep($nextStep->reveal());

        $this->assertSame($expected->reveal(), $pipeline->process($resource->reveal()));
    }
}
