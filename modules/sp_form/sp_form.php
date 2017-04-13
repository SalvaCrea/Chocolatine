<?php

use \salva_powa\sp_module;

class sp_form extends sp_module
{
  /**
   * The data stock the all forms
   * @var array
   */
    var $forms = array();

    function __construct()
    {
				global $sp_core;

        $this->icon = 'fa-check-square-o';
				$this->name = 'SP Form';
        $this->slug = 'sp_form';
				$this->description = "For generate the form";


        $this->add_ajax_action(
						array(
							'name' => 'Save form  for class',
							'call_back' => 'save_form',
							'sub_module' => 'save_form'
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

        $data = $args['args'];

        $module = $this->core->modules->get_module( $data['module'] );
        $sub_module = $module->{$data['sub_module']};

        $schema = $sub_module->data_schema();

        if ( $schema['save'] == 'simple')
              $this->save_form_simple( $data );

        return true;

    }
    function save_form_simple( $data )
    {

      update_option(
        $data['name_form']
      , json_encode( $data )
      );

    }
}
