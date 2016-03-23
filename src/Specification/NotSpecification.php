<?php

namespace Alchemy\Pipeline\Specification;

use Alchemy\Pipeline\Specification;
use Alchemy\Resource\Resource;

class NotSpecification implements Specification
{
    /**
     * @var Specification
     */
    private $negatedSpecification;

    public function __construct(Specification $specificationToNegate)
    {
        $this->negatedSpecification = $specificationToNegate;
    }

    /**
     * @param \Alchemy\Resource\Resource $resource
     * @return bool
     */
    public function isSatisfiedBy(Resource $resource)
    {
        return ! $this->negatedSpecification->isSatisfiedBy($resource);
    }
}
