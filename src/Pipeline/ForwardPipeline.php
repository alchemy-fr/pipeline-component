<?php

/*
 * This file is part of alchemy/pipeline-component.
 *
 * (c) Alchemy <info@alchemy.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alchemy\Pipeline\Pipeline;

use Alchemy\Pipeline\Pipeline;
use Alchemy\Pipeline\PipelineElement;
use Alchemy\Resource\Resource;

class ForwardPipeline implements Pipeline
{
    /**
     * @var PipelineElement[]
     */
    private $steps = [];

    /**
     * @param PipelineElement $step
     */
    public function addStep(PipelineElement $step)
    {
        $this->steps[] = $step;
    }

    /**
     * @param \Alchemy\Resource\Resource $resource
     * @return \Alchemy\Resource\Resource
     */
    public function process(Resource $resource)
    {
        foreach ($this->steps as $step) {
            $resource = $step->execute($resource);
        }

        return $resource;
    }
}
