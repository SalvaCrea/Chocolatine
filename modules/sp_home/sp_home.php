<?php

use \salva_powa\sp_module;

class sp_home extends sp_module
{

    function __construct()
    {

        $this->icon = 'fa-home';
				$this->name = 'Home';
				$this->description = "the home for the back of the salva_back";
				$this->show_in_menu = true;
				$this->menu_position = 0;

    }
    function view_back_sp()
    {
			global $sp_core;

			$menu_left['menu_list'] =  $sp_core->module_manager->list_modules;
			$menu_left['menu_list'][ $sp_core->current_module->slug ]->selected = true;
			$menu_left['logo_url'] =  $sp_core->url_folder . '/assets/img/logo-salva-powa.png';

			// get the current module
			$current_module = $sp_core->current_module;

			$view = new sp_template();

			$args['header'] = [
				'main_title' => 'Salva Powa',
				'second_title' => 'Module : ' . $current_module->name,
				'img_backgroung' => $sp_core->url_folder . '/assets/img/header.jpg'
			];

			$args['menu_left'] = array(
				'content' => [array(
					'id' => 'col_right',
					'url' => $this->twig_render( 'menu_left.html', $menu_left),
					'method' =>'echo'
				)]
			);

			$args['content'] = array(
				'container' => 'fluid-container',
				'main_content' => [array(
					'id' => 'content_home',
					'url' => $current_module->view_back(),
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
			global $sp_core;

			wp_enqueue_script( 'massonnery', 'https://unpkg.com/masonry-layout@4.1/dist/masonry.pkgd.min.js');

			return $this->twig_render( 'home.html', array(
				'list_modules' => $sp_core->module_manager->list_modules
			));
		}
}
