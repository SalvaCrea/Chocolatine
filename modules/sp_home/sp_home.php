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
    function view_back()
    {
			global $sp_core;

			$menu_left['menu_list'] =  $sp_core->module_manager->list_modules;

			wp_enqueue_script( 'sp_home_js', $sp_core->url_folder . '/modules/sp_home/js/sp_home.js' );
			wp_enqueue_style( 'sp_home_css', $sp_core->url_folder . '/modules/sp_home/css/sp_home.css' );

			$view = new sp_template();

			$args['header'] = [
				'main_title' => 'Home Salva Powal',
				'second_title' => 'juste pour voir',
				'img_backgroung' => $sp_core->url_folder . '/assets/img/header.jpg'
			];

			$args['content'] = array(
				'main_content' => [array(
					'id' => 'content_home',
					'url' => $this->twig_render( 'home.html', array()),
					'method' =>'echo',

				)]
			);

			$args['content']['col_left'] = array(
				'content' => [array(
					'id' => 'col_right',
					'url' => $this->twig_render( 'menu_left.html', $menu_left),
					'method' =>'echo'
				)]
			);

			$view->args = $args;

			$view->generate();

    }
}
