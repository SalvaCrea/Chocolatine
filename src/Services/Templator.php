<?php

namespace Chocolatine\Services;

/**
 *  The module for the test
 */
class Templator extends \Chocolatine\Component\Service{

      public $name = "templator";

      /**
       * List des block for the template
       * @var array
       */
      public $list_block = [
        'header',
        'top_content',
        'sidebar_left',
        'sidebar_right',
        'content',
        'footer'
      ];
      /**
       *  All contain
       * @var array
       */
      public $content = array();
      /**
       *  All items for all menus
       * @var array
       */
      public $menus = array();
      /**
       * number of content in the templator
       * @var integer
       */
      public $count_content = 0;

      public function __construct(){

      }
      /**
       * use the Librarie Twig for return the template
       * @return string  all theme
       */
      public function renderer(){

            $render = '';
            $renderer = \Chocolatine\get_service( 'renderer' );

            $render = $renderer->renderer( 'main.html.twig',
              array(
                'content' => $this->content,
                'Templator' => $this
              )
            );

            echo $render;
      }
      public function makeHeader()
      {
          $asset_manager = \Chocolatine\get_manager( 'asset' );

          foreach ( $asset_manager->get_css() as $value) {
              echo "<link rel=\"stylesheet\" href=\"{$value->src}\">";
          }
          foreach ( $asset_manager->get_js_header() as $value) {
              echo "<script src=\"{$value->src}\"></script>";
          }
      }
      public function make_footer()
      {
          $asset_manager = \Chocolatine\get_manager( 'asset' );
          $data = json_encode( $asset_manager->get_data() );
          echo "
          <script>
          Chocolatine = {$data}
          </script>";

          foreach ( $asset_manager->get_js_footer() as $value) {
              echo "<script src=\"{$value->src}\"></script>";
          }
      }
      /**
       * Create the block in the dom
       * @param  string $blockName [description]
       */
      public function make_block( $blockName )
      {
            $blocks = \Chocolatine\get_manager( 'block' )->find_block_by_name( $blockName );

            if ( !empty( $blocks ) ) {
                  foreach ( $blocks as $key => $content ) {
                      echo $content->content;
                  }
            }
      }
      /**
       * Create the menu in the dom
       * @param  string $menu_name the name of menu
       */
      public function makeMenu( $menuName )
      {
            $manager = \Chocolatine\get_manager('menu');
            $router = \Chocolatine\get_service('Router');

            if ( !empty( $manager->container ) ) {

                  $menu = \Chocolatine\array_clean( $manager->container, 'menu_name', $menuName );

                  if ( empty( $menu )) {
                    return false;
                  }
                  foreach ( $menu as $key => $menu ) {

                      $active = '';

                      if ( $router->current_route == $menu->route ) {
                          $active = 'active';
                      }

                      echo
                      "
                      <li class=\" {$active}  \">
                        <a href=\"{$menu->url}\">
                          <i class=\"{$menu->icon}\"></i>
                          <span>
                          {$menu->text}
                        </span>
                        </a>
                      </li>
                      ";
                  }

            }
      }
}
