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
       * Add items menu  in the templator
       * @param instance $TemplatorContent Instance of sp_framework\Pattern\TemplatorItemMenu::class;
       */
      public function add_item_menu( $TemplatorItemMenu )
      {
                /**
                 *
                 * Create the menu if undefined
                 *
                 */
                if ( empty ( $this->content[ $TemplatorItemMenu->menu_name ] ) ) {
                  $this->menus[ $TemplatorItemMenu->menu_name ] = array();
                }

                array_push( $this->menus[ $TemplatorItemMenu->menu_name ], $TemplatorItemMenu );
      }
      /**
       * use the Librarie Twig for return the template
       * @return string  all theme
       */
      public function renderer(){

            $this->extendTwig();

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
       * Function Used for add function in twig
       */
      public function extendTwig(){
        // $renderer = \sp_framework\get_service( 'renderer' );

        // $function = new \Twig_SimpleFunction('make_block', function ( $blockName ) {
        //      $templator = \sp_framework\get_service( 'templator' );
        //      $templator->make_block( $blockName );
        // });
        // $renderer::$twig->addFunction( $function );
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
            if ( !empty( $this->menus[ $menuName ] ) ) {

                  foreach ( $this->menus[ $menuName ] as $key => $menu ) {
                      echo
                      "
                      <li class=\" active  \">
                        <a href=\"{$menu->route}\">
                          <i class=\"fa {$menu->icon}\"></i>
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
