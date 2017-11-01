<?php
namespace sp_framework\Pattern\Module;

class Element
{
    function __get( $name )
    {

      if ( $name == 'core' ){
          return \sp_framework\get_core();
      }


      if ( $name == 'db' ){
          return \sp_framework\get_service( 'database' )->database;
      }


    }
    /**
     * use for get the module
     */
     public function get_father(){

     }
     /**
      * Use a template for create html
      * @param  string $templateName string for find a view
      * @param  array  $args         $args in template
      * @return string               html content
      *
      *  Example Template Name
      *  namemodule@nametemplate
      *  Or
      *  Just name for template in Theme
      *
      */
     public function renderTemplate( $templateName, array $args = [] ){

       $render = \sp_framework\get_service( 'renderer' );

       if ( false !== $stringPos = strpos( $templateName, '@') ) {

            $module_name = substr (  $templateName , 0 , $stringPos );
            $template = substr (  $templateName , $stringPos + 1 , strlen( $templateName ) );
            $module = \sp_framework\get_module( $module_name );

            $templatepath = $module->path_folder . '/template/' . $template;

            return $render->fast_render(
                file_get_contents(  $templatepath ),
                $args
            );
       }



     }
}
