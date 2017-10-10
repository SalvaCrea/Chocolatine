<?php

namespace sp_framework\Admin;

class Run{
  public function __construct(){
    echo 'admin';
    if ( is_admin() )
        add_action('admin_menu', array( $this, 'wp_admin_action' ));

        // add a menu compatible Wordpress
        add_menu_page(
          'SP Framework',
          'SP Framework',
          'administrator',
          $this->slug,
          array( $this,'create_back_view' ),
          'dashicons-hammer',
          10
        );
  }
}
