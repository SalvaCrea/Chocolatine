<?php

use \salva_powa\sp_module;

class sp_home extends sp_module
{
		/**
		 * The content of menu left
		 * @var array
		 */
		var $menu_left = array();

		/**
		 * The content of menu top
		 * @var array
		 */
		var $menu_top = array();

    function __construct()
    {

        $this->icon = 'fa-home';
				$this->name = 'Home';
				$this->description = "the home for the back of the salva_back";
				$this->show_in_menu = true;
				$this->menu_position = 0;

    }
    public function view_back_sp()
    {
			$view = new sp_template();

			$args = array();

			// get the current module
			$current_module = $this->core->current_module;

			$this->generate_menu_left();

			if ( !empty( $current_module->module_action ) ){
						$this->generate_menu_top();

						$args['top_content'] = array(
							'content' => [array(
								'id' => 'top_admin_salva_powa',
								'url' => $this->twig_render(
									'menu_top.html',
									array( 'menu_list' => $this->menu_top)
								),
								'method' =>'echo'
							)]
						);

			}

			$args['header'] = [
				'second_title' => 'Module : ' . $current_module->name,
				'img_backgroung' => $this->core->url_folder . '/assets/img/header.jpg'
			];

			$args['menu_left'] = array(
				'content' => [array(
					'id' => 'col_right',
					'url' => $this->twig_render( 'menu_left.html', $this->menu_left),
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

			wp_enqueue_script( 'sp_home_js', $this->core->url_folder . '/modules/sp_home/js/sp_home.js' );
			wp_enqueue_style( 'sp_home_css', $this->core->url_folder . '/modules/sp_home/css/sp_home.css' );

    }
		function view_back()
		{
			global $sp_core;

			wp_enqueue_script( 'massonnery', 'https://unpkg.com/masonry-layout@4.1/dist/masonry.pkgd.min.js');

			return $this->twig_render( 'home.html', array(
				'list_modules' => $sp_core->modules->list_modules
			));
		}
		function generate_menu_left()
		{

			$menu_left['menu_list'] =  $this->core->modules->list_modules;
			$menu_left['menu_list'][ $this->core->current_module->slug ]->selected = true;
			$menu_left['logo_url'] =  $this->core->url_folder . '/assets/img/logo-salva-powa.png';

			// trie by order $menu_position
			$menu = array();
			foreach ( $menu_left['menu_list'] as $key => $value) {
				# code...
			}

			$this->menu_left = $menu_left;
		}
		function generate_menu_top()
		{

				$current_module = $this->core->current_module;

				foreach ( $current_module->module_action as $key => $value) {

					$args = $value;

					if( $this->core->current_module_action == $value['slug'] )
								$args['selected'] = true;

					$this->menu_top []= $args;
				}

		}

}
