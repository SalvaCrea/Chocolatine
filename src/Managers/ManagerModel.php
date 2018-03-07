<?php

namespace Chocolatine\Managers;

use Chocolatine\Component\Manager;

class ManagerModel extends Manager
{
    /**
     * Add a form
     * @param array $args
     */
    function add_model( $args )
    {
        $this->add( $args );
    }
}
