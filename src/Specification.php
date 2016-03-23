<?php

/*
 * This file is part of alchemy/pipeline-component.
 *
 * (c) Alchemy <info@alchemy.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alchemy\Pipeline;

use Alchemy\Resource\Resource;

interface Specification
{
    /**
     * @param \Alchemy\Resource\Resource $resource
     * @return bool
     */
    public function isSatisfiedBy(Resource $resource);
}
