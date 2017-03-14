<?php

use \salva_powa\sp_module;

class sp_taxomamy_manager extends sp_module
{

    function __construct()
    {

        $this->icon = 'fa-tags';
				$this->name = 'Taxomany manager';
				$this->description = "For create and manage taxomany";

    }
    function view_back()
    {
				global $sp_core;

				wp_enqueue_script( 'sp_taxomamy_manager_js', $sp_core->url_folder . '/modules/sp_taxomamy_manager/js/sp_taxomamy_manager.js' );

				return $this->twig_render( 'home.html', array());

    }
}
