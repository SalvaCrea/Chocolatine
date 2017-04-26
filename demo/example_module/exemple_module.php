<?php

use \salva_powa\sp_module;

class example_module extends sp_module
{

    function __construct()
    {
        $this->icon = 'fa-exchange';
				$this->name = 'Example';
				$this->description = "The module the example";
        $this->slug = "module_example";
        $this->categorie = "example";
        $this->show_in_menu = true;
    }

    /***************************************************************************
    *
    * Loader view
    *
    ***************************************************************************/

    function loader_view()
    {

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
          'name' => 'Example Sub module With View and form',
          'call_back' => 'example_module_view_and_form',
          'sub_module' => 'example_module_view_and_form',
          'slug' => 'example',
          'show_in_menu' => true
        )
      );

      $this->add_sub_module(
        array(
          'name' => 'Example Sub module no View',
          'sub_module' => 'tools_example',
          'slug' => 'tool',
          'show_in_menu' => false
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
              'name' => 'Example Ajax Action',
              'call_back' => 'example_ajax_action',
              'sub_module' => 'example_ajax_action'
            )
        );

    }

    /***************************************************************************
    *
    *   Ajax action functions
    *
    ***************************************************************************/

    function example_ajax_action( $args )
    {
        $data = $args['args'];

        $sellsy_api = sp_get_module('sellsy_api');

        return true;
    }

    /***************************************************************************
    *
    *   The getter when the module is called
    *
    ***************************************************************************/
    function getter()
    {
        $this->tool->getter_example();
    }

    /***************************************************************************
    *
    *   The views
    *
    ***************************************************************************/

    /**
     * [view_back is the view by default]
     * @return [string] [The view by default in the sp admin]
     */

    function view_back()
    {

        $this->add_module_js('home_example.js');
        $this->add_module_css('home_example.css');

        $template_var = array(
          'title' => 'Example Title'
        );

        $view =  $this->twig_render( 'create_request_subcription.html',
            $template_var
        );

        return $view;
    }

    function example_module_view_and_form()
    {
        $form  = $this->example->generate_form();

        $view =  $this->twig_render( 'form_example.html',
            array( 'form' => $form )
        );

        return $form;
    }

}
