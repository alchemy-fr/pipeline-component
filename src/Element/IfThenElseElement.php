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

class IfThenElseElement implements PipelineElement
{
    /**
     * @var Specification
     */
    private $specification;

    /**
     * @var PipelineElement
     */
    private $element;

    /**
     * @var PipelineElement
     */
    private $elseElement;

    /**
     * @param Specification $condition
     * @param PipelineElement $thenElement
     * @param PipelineElement $elseElement
     */
    public function __construct(Specification $condition, PipelineElement $thenElement, PipelineElement $elseElement)
    {
        $this->specification = $condition;
        $this->element = $thenElement;
        $this->elseElement = $elseElement;
    }

    /**
     * @param \Alchemy\Resource\Resource $resource
     * @return \Alchemy\Resource\Resource
     */
    public function execute(Resource $resource)
    {
        if ($this->specification->isSatisfiedBy($resource)) {
            return $this->element->execute($resource);
        }

        return $this->elseElement->execute($resource);
    }
}
