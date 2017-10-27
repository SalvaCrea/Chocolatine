<?php
class groovy_template_for_paiement extends NewGroovytemplate
{
    public function view()
    {
      global $post;
      $sp_core = sp_core();

      $paiement_manager = sp_get_module('paiement_manager');

      $content_front = $paiement_manager->view_front->front_view();

      $post->post_content .= $content_front;

      $this->groovy_for_wp_page();

      get_header();

        $this->generate();

      get_footer();

    }
}

$view = new groovy_template_for_paiement();
$view->view();
