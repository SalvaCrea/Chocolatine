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
					$this->add_js( 'sp_query_post.js' );

				}

    }
    /***************************************************************************
    *
    * Loader component
    *
    ***************************************************************************/

    function loader_component()
    {

      $this->add_component(
        array(
          'name' => 'Tools for query post',
          'component' => 'tools_query_post',
          'slug' => 'tool',
          'show_in_menu' => false
        )
      );

      $this->add_component(
        array(
          'name' => 'Post model',
          'component' => 'sp_wp_post',
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
              'component' => 'find_post_wp_post'
            )
        );

        $this->add_ajax_action(
            array(
              'name' => 'Give me the template for directive For Angular',
              'call_back' => 'give_me_directive',
              'component' => 'give_me_directive'
            )
        );

    }
    function give_me_directive()
    {
      return $directive = $this->twig_render( 'directive_sp_post.html' );
    }
    /**
     * [find_post Search a list of posts with a wp query]
     * @param  [array] $args [the args for wp_query]
     * @return [array]       [the list of posts with info]
     */
		function find_post( $args )
		{
       $posts = (array) $this->tool->find_post( $args );
			 return $posts;
		}
    /**
     * [find_post_full Return a complete list of posts with meta ]
     * @param  [array]  $args  [the wp_query args for search ]
     * @param  boolean $clean [if a true return the complete post clean on array data format]
     * @return [array]         [Return a list of posts]
     */
    function find_post_full( $args, $clean = false )
    {
       $posts = (array) $this->tool->find_post( $args );

       foreach ( $posts['posts'] as $key => $value) {
         $value = (array) $value;
         $posts['posts'][$key] = (array) $posts['posts'][$key];
         $meta_post =  get_post_meta( $value['ID'] );

         if ( !$clean ) {
             $posts['posts'][$key]['meta'] = $meta_post;
         }
         else if( $clean )
         {
             $meta_post = $this->tool->clean_meta( $meta_post );
             $posts['posts'][$key] = array_merge( $posts['posts'][$key], $meta_post );
         }

       }
       return $posts;
    }
    /**
     * [get_post_full return a complete one post wp with the meta]
     * @param  [type]  $id_post [the id of post]
     * @param  boolean $clean   [if true clean the result, ideal for table ]
     * @return [array]           [the post]
     */
    function get_post_full( $id_post, $clean = false )
    {

        $post =  (array) get_post( $id_post );
        $meta_post =   get_post_meta( $id_post );

        if ( !$clean ) {
            $post['meta'] = $meta_post;
            return $post;
        }
        else if( $clean )
        {

            $meta_post = $this->tool->clean_meta( $meta_post );
            $post = array_merge( $post, $meta_post );
            return $post;

        }


    }
    /***************************************************************************
    *
    *   The views
    *
    ***************************************************************************/
		function view_back()
		{
          $this->add_js( 'directive_query_post.js' );
          $view = $this->twig_render( 'home_query_post.html' );
					return $view;
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
