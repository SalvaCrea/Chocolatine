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
							'component' => 'save_form'
						)
				);

    }

		function create_form( $schema_form )
		{

			$args = array(
				'name' => '',
				'schema' => array(),
				'form' => [
          '*',
          [
            "type" => "submit",
            "title" => "Send this form",
            "style" => "btn-info"
          ]
          ],
				'model' => array()
			);

			$args = array_merge( $args, $schema_form );

			$args['slug'] = sp_clean_string( $args['name'] );

			$form =  $this->twig_render( 'basic_form.html', $args );

      $this->convert_in_js( 'form' , $args );

      $this->add_js('sp_form.js');

			return $form;

		}
    function save_form( $args )
    {

        $data = $args['args'];

        $module = $this->core->manager->module->get_module( $data['module'] );
        $component = $module->{$data['component']};

        $schema = $component->data_schema();

        if ( $schema['save'] == 'simple')
              return $this->save_form_simple( $data );

        if ( $schema['save'] == 'self' )
              return $component->save_form( $data );

    }
    function save_form_simple( $data )
    {

      update_option(
        $data['name_form']
      , json_encode( $data )
      );

      return true;

    }
}
