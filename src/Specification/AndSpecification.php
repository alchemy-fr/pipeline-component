<?php

namespace Alchemy\Pipeline\Specification;

use Alchemy\Pipeline\Specification;
use Alchemy\Resource\Resource;

class AndSpecification implements Specification
{
    /**
     * @var Specification
     */
    private $lhs;

    /**
     * @var Specification
     */
    private $rhs;

    /**
     * @param Specification $lhs
     * @param Specification $rhs
     */
    public function __construct(Specification $lhs, Specification $rhs)
    {
        $this->lhs = $lhs;
        $this->rhs = $rhs;
    }

    /**
     * @param \Alchemy\Resource\Resource $resource
     * @return bool
     */
    public function isSatisfiedBy(Resource $resource)
    {
        return $this->lhs->isSatisfiedBy($resource) && $this->rhs->isSatisfiedBy($resource);
    }
}
