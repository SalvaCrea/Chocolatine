<?php

namespace salva_powa;

class sp_ressources
{
  /**
   * All ressource js and Css for create a dynamic js table and button for export data
   */
    public static function add_ressource_export_js()
    {

          wp_enqueue_script(
              'data_table_button',
              'https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js'
             );

          wp_enqueue_script(
                  'buttons.flash',
                  '//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js'
                 );

          wp_enqueue_script(
                  'jszip',
                  '//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js'
                 );

          wp_enqueue_script(
                  'pdfmake',
                  '//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js'
                 );

          wp_enqueue_script(
                  'vfs_fonts',
                  '//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js'
                 );

          wp_enqueue_script(
                  'buttons.html5.min',
                  '//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js'
                 );

          wp_enqueue_script(
                  'buttons.print.min',
                  '//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js'
                 );
    }
    /**
     * All Ressources for SP Framework
     */
    public static function main_ressources()
    {
                $sp_core = sp_core();

         		    wp_deregister_script( 'jquery' );

         				wp_enqueue_script(
         					'Jquery',
         					'https://code.jquery.com/jquery-2.2.4.min.js'
         				);

                wp_enqueue_script(
         					'JqueryUi',
         					'https://code.jquery.com/ui/1.11.3/jquery-ui.min.js'
         				);


         				wp_enqueue_script(
         					'Angular',
         					'https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.min.js'
         				);

         				// for the form
         				wp_enqueue_script(
         					'Angular-sanitize',
         					 'https://code.angularjs.org/1.6.0/angular-sanitize.min.js'
         				 );

         				wp_enqueue_script(
         					'tv4',
         					 'https://cdnjs.cloudflare.com/ajax/libs/tv4/1.3.0/tv4.min.js'
         				 );

         				wp_enqueue_script(
         					'objectpath',
         					 $sp_core->url_folder . '/bower_components/objectpath/lib/ObjectPath.js'
         				 );

         				wp_enqueue_script(
         					'schema-form',
         					 $sp_core->url_folder . '/bower_components/angular-schema-form/dist/schema-form.min.js'
         				 );

         				wp_enqueue_script(
         					'bootstrap-decorator',
         					 $sp_core->url_folder . '/bower_components/angular-schema-form/dist/bootstrap-decorator.min.js'
         				 );

         		    wp_enqueue_style(
         					'sp_styleCss',
         					 $sp_core->url_folder . '/assets/css/style.css'
         				 );

         				 wp_enqueue_style(
          					'ring_animation_css',
          					 $sp_core->url_folder . '/assets/css/ring_animation.css'
          				 );

         				 wp_enqueue_script(
         				 	'ring_animation_js',
         				 	 $sp_core->url_folder . '/assets/js/sp_animation.js'
         				  );

         		    wp_enqueue_style(
         					'sp_boostrapCss',
         					 $sp_core->url_folder . '/bower_components/bootstrap/dist/css/bootstrap.min.css'
         				 );

         		    wp_enqueue_script(
         					'sp_boostrapJs',
         					 $sp_core->url_folder . '/bower_components/bootstrap/dist/js/bootstrap.js'
         				 );

         				 wp_enqueue_style(
          					'sp_dataTable_Css',
          					 '//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css'
          				 );

                   wp_enqueue_script(
                     'toastr.min.js',
                      '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'
                    );

                    wp_enqueue_style(
                     'toastr.min.css',
                      '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css'
                    );

          		    wp_enqueue_script(
          					'sp_dataTable_Js',
          					 '//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js'
          				 );

         				wp_enqueue_style(
         					'font_awesome',
         					 $sp_core->url_folder . '/bower_components/font-awesome/css/font-awesome.css'
         				 );
         				wp_enqueue_style(
         					'font_material_icon',
         					 '//fonts.googleapis.com/css?family=Roboto:300,400,500,700'
         				 );

         				wp_enqueue_style( 'font_roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900');

    }
}
