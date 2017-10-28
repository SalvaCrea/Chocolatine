<?php

namespace sp_framework\Services;

/**
 *  The module for the test
 */
class Templator extends \sp_framework\Pattern\Service{

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
       * Add the content in the templator
       * @param instance $TemplatorContent Instance of sp_framework\Pattern\TemplatorContent::class;
       */
      public function add_content( $TemplatorContent ){
            /**
             *
             * Create the presence of block if undefined
             *
             */
            if ( empty ( $this->content[ $TemplatorContent->block_name ] ) ) {
              $this->content[ $TemplatorContent->block_name ] = array();
            }

            array_push( $this->content[ $TemplatorContent->block_name ], $TemplatorContent );

      }
      /**
       * use the Librarie Twig for return the template
       * @return string  all theme
       */
      public function renderer(){

            $render = '';
            $renderer = \sp_framework\get_service( 'renderer' );

            $asset_manager = \sp_framework\get_manager( 'asset' );

            $render = $renderer->renderer( 'main.html.twig',
              array(
                'assets'  => $asset_manager->container,
                'content' => $this->content,
                'Templator' => $this
              )
            );

            echo $render;
      }

      /**
       * Create the block in the dom
       * @param  string $blockName [description]
       */
      public function make_block( string $blockName )
      {
            if ( !empty( $this->content[ $blockName ] ) ) {
                  foreach ( $this->content[ $blockName ] as $key => $content ) {
                      echo $content->content;
                  }
            }
      }
      /**
       * Create the menu in the dom
       * @param  string $menu_name the name of menu
       */
      public function make_menu( string $menuName )
      {
            $manager = \sp_framework\get_manager( 'menu' );
            $router = \sp_framework\get_service( 'Router' );

            $router->current_route;

            if ( !empty( $manager->container[ $menuName ] ) ) {

                  foreach ( $manager->container[ $menuName ] as $key => $menu ) {

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
