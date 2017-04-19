<?php
use \Mailjet\Resources;
use \salva_powa\sp_module;

class sp_mailjet extends sp_module
{

    function __construct()
    {

        $this->icon = 'fa-paper-plane-o';
				$this->name = 'Api MailJet';
        $this->slug = 'mailjet_api';
				$this->description = "Configuration de mailjet";
				$this->show_in_menu = true;
				$this->menu_position = 1;
        $this->categorie = 'api';

        $this->add_sub_module(
					array(
						'name' => 'Configuration de MailJet',
						'call_back' => 'config_mailjet',
            'sub_module' => 'config_mailjet',
            'slug' => 'config',
            'show_in_menu' => false
					)
				);

        $this->add_sub_module(
					array(
						'name' => 'Functions MailJet',
            'sub_module' => 'tools_mailjet',
            'slug' => 'tool',
            'show_in_menu' => false
					)
				);

    }
    /**
     * The interface of configuration for api mail jet
     * @return string contain the form of configuration
     */
    function view_back()
    {

      $form = $this->config->generate_form();

      $view =  $this->twig_render( 'config_mailjet.html',
          array( 'form' => $form )
      );

      return $view;

    }

    /**
     * Send mail with api mail jet
     * @param  array $args argument for send simple mail
     * @param  int the id of template mail jet
     * @param  array the variable for the html templatage
     * @return array  the response of api Mail jet
     */
    function send_mail( $args, $template = false, $var_template = array() )
    {
        $model = $this->config->get_model();
        $mj = $this->tool->get_mj();

        $args_default = array(
          /**
           * The mail of the sender
           */
          'FromEmail' => $model['default_mail'],
          /**
           * The name of the sender
           */
          'FromName'  => '',
          /**
           * The subjet of the mail
           */
          'Subject' => '',
          /**
           * Containt Html of mail
           */
          'Html-part' => '',
          /**
           * Array contain list of mail
           */
          'Recipients' => array()
        );

        /**
         *  Fusion beetween args default and the defalt of function
         */
        $args = array_merge( $args_default, $args );

        /**
         * Convert the adresse in format for api mailjet
         */
        $args['Recipients'] = $this->tool->convert_mail_for_mj( $args['Recipients'] );
        /**
         * Converty html text in text simple
         */
        $args['Text-part'] = strip_tags (  $args['Html-part'] );
        /**
         * Use a template MailJet If exist
         */
        if ( !empty( $template ) ) {
            $args += array(
              'MJ-TemplateID' => $template,
              'MJ-TemplateLanguage' => true,
              'Vars' => $var_template,
            );
        }

        $response = $mj->post(Resources::$Email, ['body' => $args]);

        return array(
          'success' => $response->success(),
          'data' => $response->getData()
        );

    }


}
