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
        $this->categorie = 'develloper';

        $this->show_in_menu = true;

        $this->add_ajax_action(
						array(
							'name' => 'Save form  for class',
							'call_back' => 'save_form',
							'sub_module' => 'save_form'
						)
				);

        $this->add_sub_module(
					array(
						'name' => 'List views',
						'call_back' => 'list_views',
            'slug' => 'tools'
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
    function list_views()
    {
      $this->add_module_js( 'list_view.js' );

      $list_view = $this->core->controller->views;
      $this->convert_in_js( 'list_view', $list_view );

      $view = $this->twig_render('list_view.html');

      return $view;
    }
}
