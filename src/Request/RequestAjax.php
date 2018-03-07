<?php

namespace Chocolatine\Request;

/**
 * The ajax response
 */

class RequestAjax{
    /**
     * Contain the resquest http
     * @var array
     */
    public $resquest;
    /**
     * Construct the resquest by post
     * @param array $post post by ajax
     */
    public function __construct($post){
        $this->resquest = $post;
    }
}
