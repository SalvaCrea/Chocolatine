// custom_post_type start
function custom_post_type()
{

  return {
  // start return

  "type": "array",
  "items": {

      "type": "object",
      "title" : "Configuration de votre Custom Post Type",
      "properties": {

          "name_post_type" : {
            "title": "Le nom du Post Type",
            "type": "string",
            "description" : "Identifiant sous forme de caractaire utilisé"
          },

          "rewrite" : {
            "title" : "Règles d'écritures de url",
            "type" : "object",
            "properties" : {

              "slug" : {
                "title": "Quel sera votre slug ?",
                "type": "string",
                "description" : "Si vous souhaitez avoir une Taxomany dans votre url, précisez là %votre_taxomany_slug%"
              },

              "with_front": {
                "title": "Avec Front ou sans front",
                "type": "boolean",
                "default": true
              },

              "hierarchical": {
                "title": "Votre Post Type est'il hiérachique",
                "type": "boolean",
                "default": false,
              }

            }
          },

          // start arg
          "arg" : {
            "title": "Le nom du Post Type",
            "type": "object",
             "properties": {

               "description": {
                 "title": "Une courte descirption de votre post type",
                 "type": "string",
               },

               "menu_icon": {
                 "title": "Url de votre icone",
                 "type": "string",
                 "description" : "Exemple : /images/cutom-posttype-icon.png "
               },

               "public": {
                 "title": "Votre Post_Type est t'il public",
                 "type": "boolean",
                 "default": false,
                 "description" : "Votre post est par défaut privé"
               },

               "exclude_from_search": {
                 "title": "Retrouver votre post dans les recherches",
                 "type": "boolean",
                 "default": false,
                 "description" : "Votre post est par défaut privé"
               },

               "publicly_queryable": {
                 "title": "Peux t'on le retrouvé dans le Query Principale",
                 "type": "boolean"
               },

               "show_ui": {
                 "title": "Peux-t'on le trouver dans l'administration administration",
                 "type": "boolean",
                 "default": true
               },

               "show_in_menu": {
                 "title": "Peux-t'on le trouver dans l'administration menu ?",
                 "type": "boolean",
                 "default": true
               },

               "show_in_admin_bar": {
                 "title": "Peux-t'on l'afficher dans l'admin bar ?",
                 "type": "boolean",
                 "default": true
               },

               "hierarchical": {
                 "title": "Souhaitez que ce post puisse posséder des parents",
                 "type": "boolean",
                 "default": false
               },

               "menu_position": {
                 "title": "Quel est sa position dans le menu d'aministration",
                 "type": "string",
                 "enum": [ '5', '10', '15' ,'20','25','30','35','40','45','50','55','60','65','70','75','80','85','90','95','100']
               },


               "supportes" : {
                 "title": "Votre post pourra t'il supporter ?",
                 "type": "object",
                 "properties": {
                   "choice": {
                     "type": "select",
                     "titleMap": {"one":'arg1',"two":'arg2'}
                   }
                 }

              },


               "label": {
                 "title": "label Utilisé",
                 "type": "string",
                 "description" : "Le label utilisé"
               },

               "labels" : {
                 "title": "Les informations textes",
                 "type": "object",
                  "properties": {

                    "name": {
                      "title": "Nom Utilisé",
                      "type": "string",
                      "description" : "Le Nom utilisé"
                    },
                    "singular_name": {
                      "title": "Le nom dans la page admin Utilisé",
                      "type": "string",
                    },
                    "add_new": {
                      "title": "Nom d'ajout Utilisé",
                      "type": "string"
                    },
                    "add_new_item": {
                      "title": "Le nom d'ajout 2 Utilisé",
                      "type": "string"
                    },
                    "edit_item": {
                      "title": "Le nom d'édition Utilisé",
                      "type": "string",
                      "description" : "Default is Edit Post/Edit Page."
                    },
                    "new_item": {
                      "title": "Le nom d'ajout Utilisé",
                      "type": "string",
                      "description" : "Default is New Post/New Page. "
                    },
                    "view_item": {
                      "title": "label Utilisé",
                      "type": "string",
                      "description" : "Default is View Post/View Page."
                    },
                    "search_items": {
                      "title": "Nom de recherche Utilisé",
                      "type": "string",
                      "description" : "Default is Search Posts/Search Pages."
                    },
                    "not_found": {
                      "title": "Le texte par défaut quand il n'est pas trouvé",
                      "type": "string",
                      "description" : "Default is No posts found/No pages found. "
                    },
                    "not_found_in_trash": {
                      "title": "Le texte quand il n'est pas trouvé dans la corbeille",
                      "type": "string",
                      "description" : "Default is No posts found in Trash/No pages found in Trash. "
                    },
                    "parent_item_colon": {
                      "title": "Texte a utiliser pour la page parent",
                      "type": "string",
                      "description" : "This string isn't used on non-hierarchical types. In hierarchical ones the default is 'Parent Page:'. "
                    },
                    "all_items": {
                      "title": "Texte utilisé pour les sousmenus",
                      "type": "string",
                      "description" : "String for the submenu. Default is All Posts/All Pages. "
                    },
                    "archives": {
                      "title": "Texte utilisé avec les archives dans les sous menus",
                      "type": "string",
                      "description" : "String for use with archives in nav menus. Default is Post Archives/Page Archives. "
                    },
                    "insert_into_item": {
                      "title": "Texte utilisé pour les médias dans le Fram Button",
                      "type": "string",
                      "description" : "String for the media frame button. Default is Insert into post/Insert into page."
                    },
                    "uploaded_to_this_item": {
                      "title": "Texte pour le Frame Filter",
                      "type": "string",
                      "description" : "String for the media frame filter. Default is Uploaded to this post/Uploaded to this page. "
                    },
                    "featured_image": {
                      "title": "Texte utilisé l'image principale",
                      "type": "string",
                      "description" : "Default is Featured Image."
                    },
                    "set_featured_imag": {
                      "title": "Texte pour initié l'image principale",
                      "type": "string",
                      "description" : "Default is Set featured image."
                    },
                    "remove_featured_image": {
                      "title": "Texte pour suprresion l'image principale",
                      "type": "string",
                      "description" : "Default is Remove featured image."
                    },
                    "use_featured_image": {
                      "title": "Texte pour utiliser l'image principale",
                      "type": "string",
                      "description" : "Default is View Post/View Page."
                    },
                    "menu_name": {
                      "title": "Nom utilisé dans le menu",
                      "type": "string",
                      "description" : "Default is the same as `name`. "
                    },
                    "filter_items_list": {
                      "title": "Texte utilisé pour le tableau vu dans le menu caché",
                      "type": "string",
                      "description" : "Default is View Post/View Page."
                    },
                    "items_list_navigation": {
                      "title": "Texte utilisé dans la pagination cachée du header",
                      "type": "string",
                      "description" : "Default is View Post/View Page."
                    },
                    "name_admin_bar": {
                      "title": "Nom dans la bar d'aministration",
                      "type": "string",
                      "description" : "String for the table hidden heading. "
                    },


                }
                // end labels proprertie
                }
                // end labels
             }
             // end arg
          }
         // end items properties
         }
         // end items
      }
    // end return
    }
}
// custom_post_type End
