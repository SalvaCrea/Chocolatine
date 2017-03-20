<?php

use \salva_powa\sp_module;

class sp_custom_post_manager extends sp_module
{

    function __construct()
    {

        $this->icon = 'fa-file-o';
				$this->name = 'Custom post manager';
				$this->description = "For create and manage custom post";
				add_action( 'init', array( $this, 'generate_custom_post' ), 0 );

    }
    function view_back()
    {

				global $sp_core;


				$form =  new sp_form();


				$form_arg = 	array(
						'name' => $this->slug,
						'schema' => $this->schema_data(),
						'form' => $this->form_data()
					)

				if ( !empty( $sp_core->config[ $this->slug ] ) && isset( $sp_core->config[ $this->slug ] ) ) {
						$form_arg['model'] = array( $this->slug => $sp_core->config[ $this->slug ] );
				}

				$form = $form->generate_form( $form_arg );

				return $this->twig_render( 'home.html', array('form' => $form) );

    }
		function generate_custom_post()
		{
				global $sp_core;

				if ( !isset( $sp_core->config[ $this->slug ] ) || empty( $sp_core->config[ $this->slug ] ) )
						return false;

				foreach ( $sp_core->config[ $this->slug ] as $key => $custom_post) {

					    $labels =  array(
					      'name'          => $custom_post['name'],
					      'singular_name' => $custom_post['name'],
					      'all_items'     => 'Toutes les ' .$custom_post['name'],
					      'edit_item'     => 'Éditer le ' .$custom_post['name'],
					      'view_item'     => 'Voir le ' . $custom_post['name'],
					      'update_item'   => 'Mettre à jour le ' . $custom_post['name'],
					      'add_new_item'  => 'Ajouter un ' . $custom_post['name'],
					      'new_item_name' => 'Nouveau ' . $custom_post['name'],
					      'search_items'  => 'Rechercher parmi les ' . $custom_post['name'],
					      'popular_items' => $custom_post['name'] . ' les plus utilisés',
								'parent_item_colon' => 'Page liée'

					  );

					  $label = array(
							'public' => true,
							'has_archive' => true,
							'hierarchical' => true,
					    'capability_type' => 'post',
					    'supports' => array(
					      'title',
					      'editor',
					      'author',
					      "custom-fields",
					     'page-attributes',
							 "post-parent"
						 	)
						);

						$args = array( 'labels' => $labels, $label );

						register_post_type( sp_clean_string( $labels['name'] ) , $arg);

				}

		}
		function schema_data()
		{

			$schema = array(
		  "type" => "object",
		  "title" => 'Custom Post Manager',
		  "properties" =>
				[
			   $this->slug => [
			      "type" => "array",
			      "items" => [
			        "type" => "object",
			        "properties" => [
			          "name" => [
			            "title" => "Name",
			            "type" => "string"
			          ],
								"hierarchical" => [
									"title" => "Hierarchical",
						      "type" => "boolean",
        					"default" => true
						    ],
								"rewrite" => [
			            "title" => "Rewrite",
			            "type" => "string"
			          ]
			        ],
			        "required" => [
			          "name"
			        ]
			      ]
			    ]
			  ]
		);

		return $schema;
		}
		function form_data()
		{

				$form = [
			  [
			    "key" => $this->slug,
			    "type" => "tabarray",
			    "add" => "New Custom Post Type",
			    "remove" => "Delete Custom Post Type",
			    "style" => [
			      "remove" => "btn-danger"
			    ],
			    "title" => '{{ value.name || \'Tab \'+ $index }}',
			    "items" => [
			      $this->slug . "[].name",
			      $this->slug . "[].hierarchical",
						$this->slug . "[].rewrite"
			    ]
			  ]
			];

			return $form;

		}
}
