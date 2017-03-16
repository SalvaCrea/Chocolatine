<?php

use \salva_powa\sp_module;

class sp_form extends sp_module
{

    function __construct()
    {

        $this->icon = 'fa-check-square-o';
				$this->name = 'SP Form';
				$this->description = "For generate the form";

    }
		function generate_form( $schema_form )
		{

			$args = array(
				'name' => '',
				'schema' => array(),
				'form' => ['*'],
				'model' => array();
			);

			$args = array_merge( $args, $schema_form );

			$args['slug'] = sp_clean_string( $args['name'] );

			$form = twig_rend( 'basic_form.html', $args );

			return $form;
		}
}
