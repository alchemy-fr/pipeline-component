<?php

namespace Alchemy\Pipeline;

use Alchemy\Pipeline\Specification;

final class Specifications
{

    public static function andSpecs(Specification $lhs, Specification $rhs)
    {
        return new Specification\AndSpecification($lhs, $rhs);
    }

    public static function orSpecs(Specification $lhs, Specification $rhs)
    {
        return new Specification\OrSpecification($lhs, $rhs);
    }

    public static function notSpec(Specification $specification)
    {
        return new Specification\NotSpecification($specification);
    }
}
