<?php

use \salva_powa\sp_module;

class sp_taxomamy_manager extends sp_module
{

    function __construct()
    {

        $this->icon = 'fa-tags';
				$this->name = 'Taxomany manager';
				$this->description = "For create and manage taxomany";

				add_action( 'init', array( $this, 'generate_tax' ), 0 );

    }
    function view_back()
    {

				global $sp_core;

				wp_enqueue_script( 'sp_taxomamy_manager_js', $sp_core->url_folder . '/modules/sp_taxomamy_manager/js/sp_taxomamy_manager.js' );

				$model = json_encode ( array( $this->slug => $sp_core->config[ $this->slug ] ) );

				return $this->twig_render( 'home.html', array('model' => $model) );

    }
		function generate_tax()
		{
				global $sp_core;

				foreach ( $sp_core->config[ $this->slug ] as $key => $taxomany) {

					$taxomany['slug'] = sp_clean_string( $taxomany['name'] );
					$taxomany['hierarchical'] =  $taxomany['hierarchical'] === 'true'? true: false;

					$labels = array(
						'name'              => _x( $taxomany['name'], "Etiquettes de {$taxomany['name']}" ),
						"singular_name"     => _x( $taxomany['name'], "taxonomy singular name" ),
						"search_items"      => __( "Chercher les {$taxomany['name']}s" ),
						"all_items"         => __( "Toutes les {$taxomany['name']}s" ),
						"parent_item"       => __( "Destination parent" ),
						"parent_item_colon" => __( "Destination type:" ),
						"edit_item"         => __( "Editer une {$taxomany['name']}" ),
						"update_item"       => __( "Mise à jour " ),
						"add_new_item"      => __( "Ajouter une {$taxomany['name']}" ),
						"new_item_name"     => __( "Nouvelle {$taxomany['name']}" ),
						"menu_name"         => __( $taxomany['name'] ),
					);

					$args = array(
						"hierarchical"      => $taxomany['hierarchical'],
						"labels"            => $labels,
						"show_ui"           => true,
						"show_admin_column" => true,
						"query_var"         => true,
						"rewrite"           => array( "slug" => $taxomany['rewrite'] ),
					);

				// Taxomany Type de Page
				// /////////////////////////

				register_taxonomy( $taxomany['slug'], array( 'post'), $args );
				}

		}
		function schema_data()
		{
			$schema = array(
		  "type" => "object",
		  "title" => "Comment",
		  "properties" =>
				[
			    "sp-taxomany-manager" => [
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
						      "type" => "boolean"
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
			    "key" => "sp-taxomany-manager",
			    "type" => "tabarray",
			    "add" => "New Taxomany",
			    "remove" => "Delete Taxomany",
			    "style" => [
			      "remove" => "btn-danger"
			    ],
			    "title" => "{{ value.name || 'Tab '+ $index }}",
			    "items" => [
			      "sp-taxomany-manager[].name",
			      "sp-taxomany-manager[].hierarchical",
						"sp-taxomany-manager[].rewrite"
			    ]
			  ]
			];

			return $form;

		}
}
