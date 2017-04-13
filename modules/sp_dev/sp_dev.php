<?php

use \salva_powa\sp_module;

class sp_dev extends sp_module
{
  /**
   * The data stock the all forms
   * @var array
   */
    var $forms = array();

    function __construct()
    {
				global $sp_core;

        $this->icon = 'fa-laptop';
				$this->name = 'SP Maintenance';
				$this->description = "For generate the form";

        $this->show_in_menu = true;

        $this->add_ajax_action(
						array(
							'name' => 'Save form  for class',
							'call_back' => 'save_form',
							'sub_module' => 'save_form'
						)
				);

    }
    function view_back()
    {
      $modules = $this->core->modules->list_modules;
      $modules['sp_home']->actif = 'active';

      $view =  $this->twig_render(
        'sp_dev_home.html',
          array(
            'modules' => $modules
          )
      );
      return $view;
    }
    function view_module()
    {

    }
}
