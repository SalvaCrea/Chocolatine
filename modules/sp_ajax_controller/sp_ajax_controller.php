<?php

// permet que wordpress le comprennent bien



function word_sp_ajax_controller()
{

require_once(dirname(__FILE__).'/sp_ajax_controller.php');

wp_die();

}

use \salva_powa\sp_module;

class sp_ajax_controller
{
    //  (string) l'action que doit effectuer le code
    var $action = '';
    //  (array) arguments envoyé en ajax
    var $args = array();
    // (array) id des pots selectionnés
    var $id_posts = array();
    // id users id des users selectionné
    var $id_users = array();
    // (array) le retour attendu par le, do permet de savoir si l'action à bien été faite
    var $return_r = array('do'=>false, 'data' => array());
    // (boolean) savoir si on retourn les infomations en json, les retournes nativement en ajax
    var $json_return = true;
    // (json) le schema de donne lié à un post type
    var $json_schema_content;
		function __construct()
    {
				global $sp_core;

        $this->icon = 'fa-tasks';
				$this->name = 'Ajax Controller';
				$this->description = "The class for the awesome ajax";

				add_action( 'wp_ajax_sp_ajax_controller', 'word_sp_ajax_controller' );
				add_action('wp_ajax_nopriv_sp_ajax_controller', 'word_sp_ajax_controller');

				wp_enqueue_script( 'sp_ajax_controller', $sp_core->url_folder . '/modules/sp_ajax_controller/js/sp_ajax_controller.js' );

    }
    function controller()
    {

      if ( $this->action == 'add-post'  ) {

          $this->insert_post();

      }
      else if ( $this->action == 'delete-post'  )
      {

          $this->delete_post();

      }
      else if ( $this->action == 'update-post'  )
      {

          $this->update_post();

      }
      // c''est le moment de tout donner à l'ajax
      if ( $this->json_return ) {

        echo json_encode( $this->return_r );

      }
      else
      {
        return $this->return_r;
      }

    }

    // fonction pour dire que avec le ajax on est copain et que c'est bien retourné
    function valid_return()
    {
        $this->return_r['do'] = true;
    }
    /////////////////////////////////////////////////////
    //  POST ACTION
    /////////////////////////////////////////////////////

    function insert_post()
    {

          $id = wp_insert_post(  $this->args  );
          $this->return_r['data'] = $id;
          if ( is_wp_error( $id ) != true && $id !=0  ) {
              $this->valid_return();
          }
    }

    function delete_post()
    {

          $id = wp_delete_post(  $this->args['id'] );

          // si il y pas d'erreur il ne rentre pas dedans
          if ( $id != false )
          {
              $this->valid_return();
          }
              $return_r['data'] = $id;

    }

    // ///////////////////////////////////////////////////////
    //    Update Post -- Fonction
    ///////////////////////////////////////////////////////////


    function update_post()
    {
        $args = [];

        // récupération des informations par rapport à wordpress
        $col_wordpress = ['ID', 'post_author', 'post_type', 'post_status', 'post_content', 'post_title', 'post_parent'];

        foreach ( $col_wordpress as $key ) {

              if ( !empty( $this->args[$key] ) )
              {
                  if ( is_array (  $this->args[$key] ) )
                  {
                          $args[$key] =  $this->args[$key][0];
                  }
                  else
                  {
                          $args[$key] =  $this->args[$key];
                  }
              }

        }

        $this->return_r['data'] = wp_update_post( $args );

        if ( !empty( $args['ID'] ) && !empty( $args['post_author']   ) ) {

            $this->json_schema_content = json_decode( file_get_contents( get_template_directory_uri().'/data_schema/schema_'.$args['post_type'].'.json' ), true  );
            $json_chema = $this->json_schema_content['properties'];

            foreach ($json_chema as $keySchema => $valueSchema) {

              // si c'est une donnée wordpress de la post, alors on ne la stocke pas en post_meta
              if ( $valueSchema['wp_data'] )
                        continue;

                foreach ($this->args as $keyArg => $valueArg) {

                  if ($keySchema == $keyArg) {

                      if ( $valueSchema['type'] == 'tax' ) {


                        $a =  wp_set_post_terms( $args['ID'], $valueArg, $valueSchema['taxomany'] );

                      }
                      else {

                          if ( !empty( $valueArg ) && $valueArg[0] != 'NULL' && !ctype_space( $valueArg[0] ) ) {

                             update_post_meta( $args['ID'], $keyArg, $valueArg[0] );

                          }
                          else if( empty( $valueArg ) || $valueArg[0] == 'NULL' || ctype_space( $valueArg[0] ) ){

                            delete_post_meta( $args['ID'], $keyArg);

                          }




                      }

                  }


                }

            }

        }

        $this->return_r['record'] = get_post_all( $args['ID'] );

        update_post_meta( $args['ID'], 'json_data', json_encode( $this->return_r['record'] ) );
        $this->valid_return();

    }


}

 ?>
