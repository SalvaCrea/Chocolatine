<?php

$sp['menu'] = [
                      array(
                          'parent_slug' => 'salva_powa', //(string) (Required) The slug name for the parent menu (or the file name of a standard WordPress admin page).
                          'page_title' => 'Sub Menu', // (string) (Required) The text to be displayed in the title tags of the page when the menu is selected.
                          'menu_title' => 'Sub Menu', // (string) (Required) The text to be used for the menu.
                          'capability' => 'administrator', // (string) (Required) The capability required for this menu to be displayed to the user.
                          'menu_slug' => 'sp_sub_menu', // (string) (Required) The slug name to refer to this menu by (should be unique for this menu).
                          'function' => 'sp_sub_menu', // (callable) (Optional) The function to be called to output the content for this page.
                      )
                    ];

add_action('admin_menu', 'sp_menu');

function sp_menu() {

   global $sp;

   // add menu in the wp-admin
   add_menu_page('Salva Powa', 'Salva Powa', 'administrator', 'salva_powa', 'sp_home',   'dashicons-hammer', 1);

   foreach ($sp['menu'] as $page) {

        $args = array(
            'parent_slug' => 'sp', //(string) (Required) The slug name for the parent menu (or the file name of a standard WordPress admin page).
            'page_title' => '', // (string) (Required) The text to be displayed in the title tags of the page when the menu is selected.
            'menu_title' => '', // (string) (Required) The text to be used for the menu.
            'capability' => '', // (string) (Required) The capability required for this menu to be displayed to the user.
            'menu_slug' => '', // (string) (Required) The slug name to refer to this menu by (should be unique for this menu).
            'function' => '', // (callable) (Optional) The function to be called to output the content for this page.
        );

        $args = array_merge( $args, $page );

        add_submenu_page(
          $args['parent_slug'],
          $args['page_title'],
          $args['menu_title'],
          $args['capability'],
          $args['menu_slug'],
          $args['function']
          );

   }

}
