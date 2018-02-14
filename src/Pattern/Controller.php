<?php

namespace Chocolatine\Pattern;

class Controller{
    public function render( $template, $args = [] )
    {
        $serviceRenderer = \Chocolatine\get_service( 'renderer' );
    }
}
