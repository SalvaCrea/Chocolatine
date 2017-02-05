function post_custom_taxomany( $scope ) {
    return {
        // start return
        "type": "array",
        "items": {
            "title": "Votre Custom Taxomany",
            "description": "Une description test",
            "type": "object",
            "properties": {

                "taxomany": {
                    "title": "Le nom de votre taxomany",
                    "type": "string",
                    "description": "Quel est le nom de votre taxomany ( seulement des miniscule )"
                },

                "object_type": {
                    "title": "à Quel post sont reliés votre taxomany",
                    "type": "array",
                    "items" : {
                      "type" : "object",
                      "properties" : {
                        "name_post_type" : {
                          "type" : "string",
                          "enum" : test( $scope.mechant )
                        }
                      }

                    }
                },

                "arguments": {
                    "title": "Les arguments de votre Taxomany",
                    "type": "object",
                    "properties": {
                        "hierarchical": {
                            "title": "Sont-il des données hiérachique ? ",
                            "type": "boolean",
                            "default": true,
                            "description": "( hierarchical )"
                        },
                        "show_ui": {
                            "title": "Sont-il des données hiérachique ? ",
                            "type": "boolean",
                            "default": true,
                            "description": "( show_ui ) Faire apparaitre pour l'utilisateur"
                        },
                        "show_admin_column": {
                            "title": "Sont-il des données hiérachique ? ",
                            "type": "boolean",
                            "default": true,
                            "description": "( show_admin_column ) Faire apparaitre dans l'administration"
                        },
                        "query_var": {
                            "title": "Sont-il des données hiérachique ? ",
                            "type": "boolean",
                            "default": true,
                            "description": "( query_var )"
                        },
                        "rewrite": {
                            "type" : "object",
                            "properties" : {
                                "slug" : {
                                  "type" : "string",
                                  "title" : "Adresse URL Web",
                                  "description" : " ( rewrite ) Voulez une adresse de réécriture"
                                },
                                "with_front": {
                                    "title": "Un petit permalink avant ? ",
                                    "type": "boolean",
                                    "default": true,
                                    "description": "( with_front ) Permettant aux permalinks d'être ajoutés avant avec la base avant"
                                },
                                "hierarchical": {
                                    "title": "Une petite url hiérachique ? ",
                                    "type": "boolean",
                                    "default": true,
                                    "description": "( hierarchical ) "
                                },
                            }
                        }
                    }
                },

                "labels": {
                    "type": "object",
                    "title": "Informations utilisées dans le formulaire",
                    "properties": {

                        "name": {
                            "type": "string",
                            "title": "Nom dans le Formulaire"
                        },
                        "singular_name": {
                            "type": "string",
                            "title": "Le nom unique"
                        },
                        "search_items": {
                            "type": "string",
                            "title": "( search_items ) Texte utilisé pour les recherches"
                        },
                        "all_items": {
                            "type": "string",
                            "title": "( all_items ) Texte utilisé pour toutes les retrouver"
                        },
                        "parent_item": {
                            "type": "string",
                            "title": "( parent_item ) Texte utilisé pour le parent"
                        },
                        "parent_item_colon": {
                            "type": "string",
                            "title": "( parent_item_colon ) Texte du parent dans la collonne"
                        },
                        "edit_item": {
                            "type": "string",
                            "title": "( edit_item ) Texte utilisé pour l'édition"
                        },
                        "update_item": {
                            "type": "string",
                            "title": "( update_item ) Texte utilisé pour la mise à jour"
                        },
                        "add_new_item": {
                            "type": "string",
                            "title": "( add_new_item ) Texte utilisé pour ajouter un item"
                        },
                        "new_item_name": {
                            "type": "string",
                            "title": "( new_item_name ) Texte utilisé pour ajouter un item"
                        },
                        "menu_name": {
                            "type": "string",
                            "title": "( menu_name ) Texte utilisé pour le menu"
                        },

                    }
                }


            }
        }
    }
}
