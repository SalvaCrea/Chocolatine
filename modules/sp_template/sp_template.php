<?php

use \salva_powa\sp_module;

class sp_template extends sp_module
{

	// ( array ) un tableau contenant toutes les informations pour la génération du contenu
	var $args;

	var $header_img_default = "http://tripconnexion.com/wp-content/uploads/2016/03/agence-de-voyage-locales-3.jpg";

	function __construct()
	{

			$this->icon = 'fa-file-text-o';
			$this->name = 'SP Template';
			$this->slug = 'sp_template';
			$this->description = "The motor of template";
			$this->angular_apps = '';
	}

	function generate( $args = array() )
	{

		$args_default = array(
				'angular_apps' => ''
		);

		$angular_apps_html = '';

		$args = array_merge($args_default, $args);


		if ( !empty( $args['angular_apps'] ) ) {
				$this->angular_apps = $args['angular_apps'];
				$angular_apps_html = "ng-app='{$this->angular_apps}'";
		}

		$this->dependency();

		$id_css = $this->current_module->slug;

		if ( !empty( $this->current_sub_module['slug'] ) ) {
			 $id_css .= $this->current_sub_module['slug'];
		}

		echo "<div id=\"groovy_template\" {$angular_apps_html} class=\"{$id_css}\" >";

		do_action('start_groovy_template');

		if ( isset( $this->args['menu_left'] ) )
		{
			$this->menu_left();
			echo '<div id="menu_left_exist">';
		}


		if ( isset( $this->args['header'] ) )
				$this->header();

		if ( isset( $this->args['top_content'] ) )
				$this->top_content();

		if ( isset( $this->args['content'] ) )
				$this->content();

		if ( isset( $this->args['footer'] ) )
				$this->footer();

		do_action('end_groovy_template');

		if ( isset( $this->args['menu_left'] ) )
				echo '</div>';

		echo "</div>";

	}

	function dependency(){

		$this->add_module_css( 'sp_template.css' );
		$this->add_module_js('sp_template.js');

	}
	function generate_content( $arg ){

			foreach ( $arg as $value) {

				switch ( $value['method'] ) {
					case 'echo':
						echo( $value['url'] );
						break;
					case 'twig':
						$template = $twig->loadTemplate( $widgetname.'.html');
						$html.= $template->render( $value['url'] );
						break;
					case 'require':
						include $value['url'];
						break;
					case 'callback':
							call_user_func( $value['url'] );
							break;
					case 'wp_content':

							while ( have_posts() ) : the_post(); ?>

									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

											<?php the_content(); ?>

									</article><!-- #post -->

								<?php endwhile;

							break;
				}

			}

	}
	function menu_left()
	{

		$args = array(
			"rules_boostrap" => "",
			"after" => "",
			"before" => "",
			"backgound" => ""
		);

		$args = array_merge( $args, $this->args['menu_left'] );

		echo '<div id="sp_menu_left" class="col-md-3">';

				$this->generate_content( $this->args['menu_left']['content'] );

		echo '</div>';

	}
	// permet de créer un header
	function header()
	{
			$args = array(
				 "main_title" => "",
				 "second_title" => "",
				 "before" => "",
				 "after" => "",
				 "content" => "main",
				 "img_backgroung" => $this->header_img_default,
			);

			$args = array_merge( $args, $this->args['header'] );
			echo "
			<div id=\"headerpage\" class=\"container-fluid\" style=\"background-image:url('{$args['img_backgroung']}')\" >
			";

			if ( $args['content'] == 'main' ) {
				echo "
				{$args['before']}
					<div class=\"titles_header\">
								<h1>
								{$args['main_title']}
								</h1>
								<h2>
								{$args['second_title']}
								</h2>
					</div>
				{$args['after']}
				";
			}
			else
			{
				$this->generate_content( $this->args['header']['content'] );
			}

			echo "
			</div>
			";
	}
	// permet de créer un bottom header
	function top_content()
	{

		echo '<div id="top-content-groovy" class="fluid-container">';
			echo '<div class="container">';

					$this->generate_content( $this->args['top_content']['content'] );

			echo '</div>';
		echo '</div>';

	}
	// permet de générer le contenu principal
	function content()
	{

		$args = array(
			"rules_boostrap" => "col-xs-12 col-sm-12 col-md-12",
			"after" => "",
			"before" => "",
			"container" => "container",
			"backgound" => "none"
		);

		if ( isset( $this->args['content']['col_left'] ) || isset( $this->args['content']['col_right'] ) )
			$args['rules_boostrap'] = "col-xs-12 col-sm-12 col-md-9";

		if ( isset( $this->args['content']['col_left'] ) && isset( $this->args['content']['col_right'] ) )
			$args['rules_boostrap'] = "col-xs-12 col-sm-12 col-md-6";

		$args = array_merge( $args, $this->args['content'] );

		echo "<div id=\"content_groovy\" style=\"background-color:{$args['backgound']}\" class=\"{$args['container']}\">";

				echo $args['after'];

				if (	isset( $this->args['content']['col_left'] )	)
					$this->content_column('col_left');

							echo "<div id=\"main_content_groovy\"  class=\"{$args['rules_boostrap']}\">";

								do_action('groovy_content_top');

								$this->generate_content( $this->args['content']['main_content'] );

								do_action('groovy_content_bottom');

							echo "</div>";

				if (	isset( $this->args['content']['col_right'] )	)
					$this->content_column('col_right');

				echo $args['before'];

		echo '</div>';

	}
	// génére les collonnes autour du content
	function content_column( $col )
	{

		$args = array(
			"rules_boostrap" => "hidden-xs hidden-sm col-md-3"
		);

		$args = array_merge( $args, $this->args['content'][$col] );

		echo "<div id=\"{$col}_groovy\" class=\"sidebar {$args['rules_boostrap']}\">";

			if (	isset( $this->args['content'][$col]['content'] )	)
				$this->generate_content( $this->args['content'][$col]['content'] );

			if (	isset( $this->args['content'][$col]['sidebar'] )	)
				dynamic_sidebar( $this->args['content'][$col]['sidebar'] );

		echo "</div>";

	}
	function view_back()
	{
		return 'dans un futur tu pourras me configurer';
	}
	// Data Schema For this Class
	function schemaComment()
	{
		global $wp_registered_sidebars;

		$sidebar = array( '' => '' );

		foreach ( $wp_registered_sidebars as $sidebar_loop ) {
				$sidebar[ $sidebar_loop['id'] ] = $sidebar_loop['name'];
		}

					$meta_boxes[] = array(
						'title'      => __( 'Configuration New Groovy Template', 'textdomain' ),
						'post_types' => array( 'post', 'page' ),
						'fields'     => array(

								array(
										'id'      => 'container',
										'name'    => __( 'Comportement du container', 'textdomain' ),
										'type'    => 'select',
										'desc'    => 'Un container fluide prend toute la page à l\'inverse d\'un contenu fixé',
										'options' => array(

											'' => '',
											'container' => 'Container Fixed',
											'container-fluid' => 'Container Fluid'

										)
								),

								array(
										'id'      => 'background_color',
										'name'    => __( 'Couleur du container', 'textdomain' ),
										'type'    => 'color',
								),

								array(
										'id'      => 'sidebar_right',
										'name'    => __( 'Side Bar Right', 'textdomain' ),
										'type'    => 'select',
										'options' => $sidebar
								),

								array(
										'id'      => 'sidebar_left',
										'name'    => __( 'Side Bar Left', 'textdomain' ),
										'type'    => 'select',
										'options' => $sidebar
								)


						),
				);

				 return $meta_boxes;
	}
}
