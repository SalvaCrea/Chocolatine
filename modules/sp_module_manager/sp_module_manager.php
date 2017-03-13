<?php

use \salva_powa\sp_module;

class sp_module_manager extends sp_module
{

    function __construct()
    {

        $this->icon = 'fa-cogs';
				$this->name = 'Managing Module';
				$this->description = "The view for managing module";

    }
    function view_back()
    {
				return 'je suis la vue';
    }
}
