<?php
use \Mailjet\Resources;
use \salva_powa\sp_module;

class sp_sellsy extends sp_module
{

    function __construct()
    {
        require 'lib/sellsyconnect.php';
        require 'lib/sellsytools.php';

        $this->icon = 'fa-money';
				$this->name = 'Api Sellsy';
        $this->slug = 'sellsy_api';
				$this->description = "Configuration de sellsy";
				$this->show_in_menu = true;
				$this->menu_position = 1;
        $this->categorie = 'api';

    }
    function loader_component()
    {
      $this->add_component(
        array(
          'name' => 'Configuration de Sellsy',
          'call_back' => 'config_sellsy',
          'component' => 'config_sellsy',
          'slug' => 'config'
        )
      );

      $this->add_component(
        array(
          'name' => 'Functions MailJet',
          'component' => 'tools_sellsy',
          'slug' => 'tool',
          'show_in_menu' => false
        )
      );
    }
    function getter()
    {
        $this->tool->sellsyConnect();
    }
    /**
     * The interface of configuration for api sellsy
     * @return string contain the form of configuration
     */
    function view_back()
    {

      $this->tool->sellsyConnect();

      $client = $this->tool->find_client();

      if ( !empty( $client->response->result ) ) {

        $this->add_module_js( 'home_sellsy.js' );

        $this->convert_in_js( 'client', $client->response );

        $view =  $this->twig_render( 'home_sellsy.html',
            array( 'client' => $client )
        );

        return $view;
      }
      else
      {
        return "Sellsy n'est pas connecté";
      }


    }
    function config_sellsy()
    {

      $form = $this->config->generate_form();

      $view =  $this->twig_render( 'config_sellsy.html',
          array( 'form' => $form )
      );

      return $view;

    }

}
