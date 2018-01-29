<?php

namespace Chocolatine\Responses;

/**
 * The ajax response
 */

class ResponseAjax{
    /**
     * Contain the resquest http
     * @var array
     */
    public $resquest;
    /**
     * Construct the resquest by post
     * @param array $post post by ajax
     */
    public function __construct( $post ){
        $this->resquest = $post;
    }
}
