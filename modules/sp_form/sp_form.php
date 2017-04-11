<?php

use \salva_powa\sp_module;

class sp_form extends sp_module
{

    function __construct()
    {
				global $sp_core;

        $this->icon = 'fa-check-square-o';
				$this->name = 'SP Form';
				$this->description = "For generate the form";


        $this->add_ajax_action(
						array(
							'name' => 'Save form  for class',
							'call_back' => 'save_form',
							'action_module' => 'save_form'
						)
				);

    }

		function create_form( $schema_form )
		{

			$args = array(
				'name' => '',
				'schema' => array(),
				'form' => ['*'],
				'model' => array()
			);

			$args = array_merge( $args, $schema_form );

			$args['slug'] = sp_clean_string( $args['name'] );

			$form =  $this->twig_render( 'basic_form.html', $args );

      $this->convert_in_js( 'form' , $args );

      $this->add_module_js('sp_form.js');

			return $form;
      
		}
    function save_form( $args )
    {

        update_option(
          $args['args']['name_form']
        , json_encode( $args['args'] )
        );

        return true;
    }
}
