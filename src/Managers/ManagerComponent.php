<?php

namespace Chocolatine\Managers;

use Chocolatine\Component\Manager;

class ManagerComponent extends Manager
{
    /**
     * Add a model
     * @param array $args
     */
    function add_model($args)
    {
        $this->add($args);
    }
}
