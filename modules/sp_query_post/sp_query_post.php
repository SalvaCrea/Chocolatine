<?php

use \salva_powa\sp_module;

class sp_query_post extends sp_module
{

    function __construct()
    {

        $this->icon = 'fa-spinner';
				$this->name = 'Sp Query Post';
				$this->description = "With me, you search personnal post and meta";
        $this->categorie = "develloper";
        $this->slug = "sp_wp_post";

				if ( is_admin() ) {
					$this->show_in_menu = true;
					$this->add_module_js( 'sp_query_post.js' );
				}

    }
    /***************************************************************************
    *
    * Loader sub module
    *
    ***************************************************************************/

    function loader_sub_module()
    {

      $this->add_sub_module(
        array(
          'name' => 'Tools for query post',
          'sub_module' => 'tools_query_post',
          'slug' => 'tool',
          'show_in_menu' => false
        )
      );

      $this->add_sub_module(
        array(
          'name' => 'Post model',
          'sub_module' => 'sp_wp_post',
          'slug' => 'post',
          'call_back' => 'view_post_model',
          'show_in_menu' => true
        )
      );

    }
    /***************************************************************************
    *
    * Loader ajax actions
    *
    ***************************************************************************/

    function loader_ajax_action()
    {
        $this->add_ajax_action(
            array(
              'name' => 'Query Find Post',
              'call_back' => 'find_post',
              'sub_module' => 'find_post_wp_post'
            )
        );
    }

		function find_post( $args )
		{
       $result = $this->tool->find_post( $args );
			 return $result;
		}

		function view_back()
		{
					return 'Uniquement pour les dev';
		}
    function view_post_model()
    {
      $form  = $this->post->generate_form();

      $view =  $this->twig_render( 'post_model.html',
          array( 'form' => $form )
      );

      return $form;
    }

}
