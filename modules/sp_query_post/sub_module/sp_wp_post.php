<?php

use \salva_powa\sp_sub_module;

class sp_wp_post extends sp_sub_module
{
        /**
         * [add_post description]
         * @param [array] $args [The arguments for add post]
         * @return [int] the id post
         */
        function add( $args )
        {

            $schema = $this->data_schema()["properties"];

            $args_default = array(
              'ID' => '',
              'post_author' => '',
              'post_date' => '',
              'post_content' => '',
              'post_title' => '',
              'post_statut' => '',
              'post_parent' => '',
              'post_type' => '',
              'meta_input' => array(
                // exemple
                // 'my_meta_key' => 'value_meta_key'
              )
            );

            $post_data_clean = array();
            $meta_data = array();
            // the loop search meta data
            foreach ( $args as $key => $value ) {
                if ( $this->is_meta_data( $key ) ) {
                    $meta_data[ $key ] = $value;
                }
                else{
                    $post_data_clean[ $key ] = $value;
                }
            }

            $post_data_clean[ 'meta_input' ] = $meta_data;

            $post_data_clean = array_merge( $args_default, $post_data_clean );
            
            // native function of wordpress for add post
            $id_post = wp_insert_post(  $post_data_clean );

            return $id_post;

        }
        function update( $id_post, $args )
        {
            $args['ID'] = $id_post;

            $r = $this->add( $args );

            return $r;
        }
        function update_meta( $id_post, $meta_key, $meta_value, $prev_value = '' )
        {
            update_post_meta( $post_id, $meta_key, $meta_value, $prev_value );
        }
        /**
         * [is_meta_data say is meta of no-footer]
         * @param  [type]  $key [The key name for insert]
         * @return boolean      [true if a meta of false is onot meta]
         */
        function is_meta_data( $key )
        {
            $schema = $this->data_schema()["properties"];

            if ( array_key_exists( $key, $schema) ) {
                return false;
            }
            else {
                return true;
            }

        }
        function data_schema()
        {

          $schema = [
            "type"=> "object",
            "save"=> "wp_post",
            "properties"=> [
              "ID"=>  [
                "title"=> "ID Post",
                "type"=> "number",
              ],
              "post_author"=>  [
                "title"=> "Post Author",
                "type"=> "number",
              ],
              "post_date"=>  [
                "title"=> "Post Date",
                "type"=> "date",
              ],
              "post_date_gmt"=>  [
                "title"=> "Post Date Gmt",
                "type"=> "date",
              ],
              "post_content"=>  [
                "title"=> "Post Content",
                "type"=> "string",
              ],
              "post_title"=>  [
                "title"=> "Post title",
                "type"=> "string",
              ],
              "post_excerpt"=>  [
                "title"=> "Post Excerpt",
                "type"=> "string",
              ],
              "post_status"=>  [
                "title"=> "Post statut",
                "type"=> "string",
              ],
              "comment_status"=>  [
                "title"=> "Comment status",
                "type"=> "string",
              ],
              "ping_status"=>  [
                "title"=> "Ping status",
                "type"=> "string",
              ],
              "post_password"=>  [
                "title"=> "Post Password",
                "type"=> "string",
              ],
              "post_name"=>  [
                "title"=> "Post Name",
                "type"=> "string",
              ],
              "post_modified"=>  [
                "title"=> "Post Modified",
                "type"=> "date",
              ],
              "post_modified_gmt"=>  [
                "title"=> "Post Modified Gmt",
                "type"=> "string",
              ],
              "post_content_filtered"=>  [
                "title"=> "Post Content Filtered",
                "type"=> "string",
              ],
              "pinged"=>  [
                "title"=> "Pinged",
                "type"=> "string",
              ],
              "post_parent"=>  [
                "title"=> "Post Parent",
                "type"=> "number",
              ],
              "guid"=>  [
                "title"=> "Guid",
                "type"=> "string",
              ],
              "menu_order"=>  [
                "title"=> "Menu order",
                "type"=> "number",
              ],
              "post_type"=>  [
                "title"=> "Post Type",
                "type"=> "string",
              ],
              "post_mime_type"=>  [
                "title"=> "Post Mime Type",
                "type"=> "string",
              ],
              "comment_count"=>  [
                "title"=> "Comment Count",
                "type"=> "number",
              ]
            ],
            "required"=> ["post_title"]
          ];

          return $schema;
        }

}
