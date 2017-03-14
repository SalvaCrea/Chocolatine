<?php

use \salva_powa\sp_module;

class sp_home extends sp_module
{

    function __construct()
    {

        $this->icon = 'fa-home';
				$this->name = 'Home';
				$this->description = "the home for the back of the salva_back";

    }
    function view_back_sp()
    {
			global $sp_core;

			$menu_left['menu_list'] =  $sp_core->module_manager->list_modules;
			$menu_left['logo_url'] =  $sp_core->url_folder . '/assets/img/logo-salva-powa.png';

			$view = new sp_template();

			$args['header'] = [
				'main_title' => 'Home Salva Powal',
				'second_title' => 'juste pour voir',
				'img_backgroung' => $sp_core->url_folder . '/assets/img/header.jpg'
			];

			$args['menu_left'] = array(
				'content' => [array(
					'id' => 'col_right',
					'url' => $this->twig_render( 'menu_left.html', $menu_left),
					'method' =>'echo'
				)]
			);

			$module = $_GET['page'];

			$args['content'] = array(
				'main_content' => [array(
					'id' => 'content_home',
					'url' => $sp_core->module_manager->list_modules[$module]->view_back(),
					'method' =>'echo',
				)]
			);

			$view->args = $args;

			$view->generate();

			wp_enqueue_script( 'sp_home_js', $sp_core->url_folder . '/modules/sp_home/js/sp_home.js' );
			wp_enqueue_style( 'sp_home_css', $sp_core->url_folder . '/modules/sp_home/css/sp_home.css' );

    }
		function view_back()
		{
			return $this->twig_render( 'home.html', array());
		}
}
