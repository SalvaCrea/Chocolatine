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

				wp_enqueue_script( 'sp_home_js', $sp_core->url_folder . '/modules/sp_form/js/sp_form.js' );

    }
		function generate_form( $schema_form )
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

			return $form;
		}
}
