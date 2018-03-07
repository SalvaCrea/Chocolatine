<?php

namespace Chocolatine\Component;

use Chocolatine\Helper;

abstract class Controller
{
    public function render(string $template, array $args = [])
    {
        $serviceRenderer = Helper::get_service('renderer');
    }
}
