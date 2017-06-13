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
        function clean_meta( $meta_data )
        {

            $meta_data = (array) $meta_data;

            $clean_meta = array();

      			foreach ( $meta_data as $key => $meta ) {

      					$clean_meta[ $key ] = $meta;

                if ( count( $clean_meta[ $key ] ) == 1 ) {
                    $clean_meta[ $key ] = $clean_meta[ $key ][0];
                }

      			}

            return $clean_meta;
        }

}
