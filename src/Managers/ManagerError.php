<?php

namespace Chocolatine\Managers;

use Chocolatine\Component\Manager;

class ManagerError extends Manager
{
    /**
     *  Add error in container
     * @param array $args Add Error an container
     */
    function addError( $args )
    {
        $this->add( $args );
    }
}
