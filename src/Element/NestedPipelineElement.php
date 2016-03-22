<?php

/*
 * This file is part of alchemy/pipeline-component.
 *
 * (c) Alchemy <info@alchemy.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alchemy\Pipeline\Element;

use Alchemy\Pipeline\Pipeline;
use Alchemy\Pipeline\PipelineElement;
use Alchemy\Resource\Resource;

class NestedPipelineElement implements PipelineElement
{
    /**
     * @var Pipeline
     */
    private $pipeline;

    /**
     * @param Pipeline $pipeline
     */
    public function __construct(Pipeline $pipeline)
    {
        $this->pipeline = $pipeline;
    }

    /**
     * @param \Alchemy\Resource\Resource $resource
     * @return \Alchemy\Resource\Resource
     */
    public function execute(Resource $resource)
    {
        return $this->pipeline->process($resource);
    }
}
