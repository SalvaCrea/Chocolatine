<?php

namespace Chocolatine\Managers;

use Chocolatine\Component\Manager;

class ManagerController extends Manager
{
    /**
     * Add view
     * @param array $args
     */
    function addView( $args )
    {
        $this->add( $args );
    }
}
