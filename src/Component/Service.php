<?php

namespace Chocolatine\Component;

abstract class Service{
    /**
     * Name of servive
     * @var string
     */
    public $name;

    public function init(){}
    /**
     * Function used by called
     */
    public function getter(){}
}
