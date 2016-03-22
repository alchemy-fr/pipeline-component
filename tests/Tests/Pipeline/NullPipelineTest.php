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

use Alchemy\Pipeline\Pipeline\NullPipeline;
use Alchemy\Resource\Resource;

class NullPipelineTest extends \PHPUnit_Framework_TestCase
{

    public function testPipelineReturnsSameResource()
    {
        $resource = $this->prophesize(Resource::class)->reveal();
        $pipeline = new NullPipeline();

        $result = $pipeline->process($resource);

        $this->assertSame($resource, $result);
    }
}
