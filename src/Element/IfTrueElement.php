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

use Alchemy\Pipeline\PipelineElement;
use Alchemy\Pipeline\Specification;
use Alchemy\Resource\Resource;

class IfTrueElement implements PipelineElement
{
    /**
     * @var Specification
     */
    private $specification;

    /**
     * @var PipelineElement
     */
    private $element;

    public function __construct(Specification $condition, PipelineElement $ifTrueElement)
    {
        $this->specification = $condition;
        $this->element = $ifTrueElement;
    }

    /**
     * @param \Alchemy\Resource\Resource $resource
     * @return \Alchemy\Resource\Resource
     */
    public function execute(Resource $resource)
    {
        if ($this->specification->isSatisfiedBy($resource)) {
            $resource = $this->element->execute($resource);
        }

        return $resource;
    }
}
