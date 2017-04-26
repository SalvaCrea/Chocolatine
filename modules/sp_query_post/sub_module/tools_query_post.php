<?php

use \salva_powa\sp_sub_module;

class tools_query_post extends sp_sub_module
{

        /**********************************************************************
        *
        *  Method Around the wordpress post
        *
        ***********************************************************************/

        function find_post( $args )
        {
            $posts = new WP_Query( $args );
            return $posts;
        }


}
