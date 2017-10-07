<?php

namespace sp_framework;

class sp_component extends sp_module
{
  var $parent_module;

   /**
 	 * Return the father of module if the module is a component
 	 * @return mixed false if not find or object if is find
 	 */
 	function get_father()
 	{
 			if ( !empty( $this->parent_module ) ) {
 					return $this->core->manager->module->get_module( $this->parent_module, false);
 			}
 			else{
 					return false;
 			}
 	}
   /**
    * Each module can have a schema of data
    * @return array the list of data
    */
   public function data_schema()
   {
     return false;
   }
   /**
    * Each module can have a  form
    * @return array the list of form
    */
   public function data_form()
   {
     return false;
   }
   /**
    * Each module can save a form
    * @return mixed
    */
   public function save_form( $args )
   {
     return false;
   }
   /**
    * Return the name of the form
    * @return string name of the form
    */
   public function get_name_form()
   {
       return $this->father->get_slug() . '_' . $this->get_slug() . '_model';
   }
   /**
    * Get data link of the module
    * @return array data of class
    */
   public function get_model()
   {
       $model = get_option(  $this->get_name_form() );

       if (  $model != false )
           return  json_decode( $model, 1);

       return false;
   }
   function generate_form()
   {
     $form =  $this->core->manager->module->get_module( 'sp_form' );

     $name = $this->get_name_form();

     $args = array(
       'name' => $name
     );

     if ( $this->data_schema() != false ){
         $args['schema'] = $this->data_schema();
         $args['schema']['title'] = $name;
         $args['schema']['module'] = $this->current_module->slug;
         $args['schema']['component'] = $this->get_slug();
     }

     if ( $this->data_form() != false )
         $args['form'] = $this->data_form();

     if (  $this->get_model() != false )
         $args['model'] = $this->get_model();

     $form = $form->create_form( $args );

     return $form;
   }
}
