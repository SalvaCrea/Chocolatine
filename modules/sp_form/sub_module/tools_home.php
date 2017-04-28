<?php

use \salva_powa\sp_sub_module;

class tools_sp_home extends sp_sub_module
{

        function __construct()
        {
              $this->name = 'tools_sp_home';
        }
        public static function url_rewrite_wp_admin()
        {
          global $wp_rewrite;
          add_rewrite_tag('%brand%','([^&]+)');
          add_rewrite_tag('%product%','([^&]+)');
          add_rewrite_tag('%color%','([^&]+)');
          $wp_rewrite->add_rule('wp-admin/([^/]+)/([^/]+)/([^/]+)','index.php?pagename=catalogue&brand=$matches[1]&product=$matches[2]&color=$matches[3]','top');

          $wp_rewrite->flush_rules();
        }

}
